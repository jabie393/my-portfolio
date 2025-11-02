// Handle multiple Filament-like notifications (vanilla JS)
(function () {
  function createIcon(type, field) {
    var span = document.createElement('span');
    span.className = 'notif-icon';
    if (type === 'success') {
      span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>';
    } else if (type === 'warning') {
      span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.59c.75 1.333-.213 2.97-1.743 2.97H3.482c-1.53 0-2.494-1.637-1.743-2.97L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-8a1 1 0 01.993.883L11 6v4a1 1 0 01-1.993.117L9 10V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>';
    } else {
      // error/info/general
      if (field === 'email') {
        span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path d="M2.94 6.94A2 2 0 014 6h12a2 2 0 011.06.94L10 11 2.94 6.94z"/><path d="M18 8.118V14a2 2 0 01-2 2H4a2 2 0 01-2-2V8.118l8 4.545 8-4.545z"/></svg>';
      } else if (field === 'password') {
        span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path fill-rule="evenodd" d="M5 8a5 5 0 1110 0v1h1a2 2 0 012 2v5a2 2 0 01-2 2H4a2 2 0 01-2-2v-5a2 2 0 012-2h1V8zm2-1a3 3 0 116 0v1H7V7z" clip-rule="evenodd"/></svg>';
      } else {
        span.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path d="M18 8A8 8 0 11.999 8 8 8 0 0118 8zM9 7h2v5H9V7zm0 6h2v2H9v-2z"/></svg>';
      }
    }
    return span;
  }

  function reflow(notifs, gap, baseTop) {
    // Recompute top positions for visible notifications
    var visible = notifs.filter(function (n) { return document.body.contains(n.el); });
    visible.forEach(function (item, i) {
      var top = baseTop + i * (item.el.offsetHeight + gap);
      item.el.style.top = top + 'px';
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    var nodes = Array.prototype.slice.call(document.querySelectorAll('.notif'));
    if (!nodes.length) return;

    var gap = 12; // px between notifications
    var baseTop = 12; // base top in px (1rem ~ 16px but keep 12 to match spacing)
    var notifs = nodes.map(function (el) { return { el: el, timer: null }; });

    notifs.forEach(function (item, idx) {
      var el = item.el;
      var type = el.dataset.type || (el.classList.contains('type-success') ? 'success' : (el.classList.contains('type-warning') ? 'warning' : (el.classList.contains('type-error') ? 'error' : 'info')));
      var field = el.dataset.field || (el.className.match(/field-([a-zA-Z0-9_-]+)/) || [])[1] || null;

      // insert icon before message
      var messageEl = el.querySelector('.message');
      var icon = createIcon(type, field);
      el.insertBefore(icon, messageEl);
      el.classList.add('has-icon');

      // initial off-screen top so translation X still handles entrance
      el.style.right = '1rem';
      el.style.top = (baseTop + idx * 60) + 'px'; // temporary; will be corrected after show when heights known
      el.style.position = 'fixed';

      // show with a small stagger so they don't all animate at once
      setTimeout(function () {
        // compute correct stacked position
        reflow(notifs, gap, baseTop);
        el.classList.add('show');

        // focus field and highlight if present
        if (field) {
          var input = document.getElementById(field);
          if (input) {
            try { input.focus(); } catch (e) {}
            input.classList.add('input-error-highlight');
            setTimeout(function () { input.classList.remove('input-error-highlight'); }, 4000);
          }
        }

        // set auto-hide timer for this notification
        item.timer = setTimeout(function hide() {
          el.classList.remove('show');
          // after transition remove from DOM and reflow
          var onTrans = function (ev) {
            if (ev.propertyName === 'opacity' || ev.propertyName === 'transform') {
              el.removeEventListener('transitionend', onTrans);
              if (el.parentNode) el.parentNode.removeChild(el);
              // remove from notifs array
              var idxRem = notifs.indexOf(item);
              if (idxRem !== -1) notifs.splice(idxRem, 1);
              reflow(notifs, gap, baseTop);
            }
          };
          el.addEventListener('transitionend', onTrans);
        }, 4000 + idx * 200);

      }, idx * 100);

      // manual close
      var closeBtn = el.querySelector('.close');
      if (closeBtn) {
        closeBtn.addEventListener('click', function () {
          if (item.timer) clearTimeout(item.timer);
          el.classList.remove('show');
          // remove quickly after transition
          setTimeout(function () {
            if (el.parentNode) el.parentNode.removeChild(el);
            var idxRem = notifs.indexOf(item);
            if (idxRem !== -1) notifs.splice(idxRem, 1);
            reflow(notifs, gap, baseTop);
          }, 240);
        });
      }
    });

    // ensure reflow runs once heights are stable
    setTimeout(function () { reflow(notifs, gap, baseTop); }, 350);

    // observe DOM mutations: if server-side pushes new notifications into DOM later, handle them
    var observer = new MutationObserver(function (mutations) {
      var added = [];
      mutations.forEach(function (m) {
        m.addedNodes && m.addedNodes.forEach(function (n) {
          if (n.nodeType === 1 && n.classList.contains('notif')) added.push(n);
        });
      });
      if (added.length) {
        // append new ones to notifs and initialize them
        added.forEach(function (n) { notifs.push({ el: n, timer: null }); });
        // re-run initialization for newly added nodes
        // (simple approach: reload page logic for all notifications)
        // avoid duplicate icons by skipping elements that already have .notif-icon
        notifs.forEach(function (item, i) {
          if (!item.el.querySelector('.notif-icon')) {
            var type = item.el.dataset.type || null;
            var field = item.el.dataset.field || null;
            var icon = createIcon(type, field);
            var messageEl = item.el.querySelector('.message');
            if (messageEl) item.el.insertBefore(icon, messageEl);
            item.el.classList.add('has-icon');
            item.el.style.position = 'fixed';
          }
        });
        reflow(notifs, gap, baseTop);
      }
    });

    observer.observe(document.body, { childList: true, subtree: true });
  });
})();
