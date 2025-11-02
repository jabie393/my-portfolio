/* ===== js preload ===== */
window.onload = function () {
  const preloader = document.getElementById('preloader');
  preloader.style.opacity = '0'; // Tambahkan animasi transisi
  preloader.style.transition = 'opacity 0.5s ease';

  // Tunggu hingga transisi selesai, lalu hapus preloader dari DOM
  setTimeout(() => {
      preloader.style.display = 'none';

      // Pastikan animasi ScrollReveal dimulai setelah preload selesai
      startAnimations();
  }, 500); // Sesuai dengan durasi transisi
};

document.addEventListener("DOMContentLoaded", () => {
  const preloader = document.getElementById('preloader');
  const progressText = document.querySelector('.progress-text');
  const spinner = document.querySelector('.spinner');

  let progress = 0;

  // Simulasikan pemuatan menggunakan interval
  const interval = setInterval(() => {
      if (progress < 100) {
          progress += 1;
          progressText.textContent = `${progress}%`;
      } else {
          clearInterval(interval);
          preloader.style.opacity = '0';
          preloader.style.transition = 'opacity 0.5s ease';
          setTimeout(() => {
              preloader.style.display = 'none';
              startAnimations(); // Pastikan fungsi ini dipanggil jika digunakan
          }, 500);
      }
  }, 30); // Percepat interval sesuai kebutuhan
});

/*===== MENU SHOW =====*/
const showMenu = (toggleId, navId) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId)

  if(toggle && nav){
      toggle.addEventListener('click', ()=>{
          nav.classList.toggle('show')
      })
  }
}
showMenu('nav-toggle','nav-menu')

/*==================== REMOVE MENU MOBILE ====================*/
// Ambil elemen toggle dan menu
const navToggle = document.getElementById('nav-toggle');
const navMenu = document.getElementById('nav-menu');

// Tambahkan event listener
navToggle.addEventListener('click', () => {
  // Toggle kelas 'show-menu' untuk menampilkan/menyembunyikan menu
  navMenu.classList.toggle('show-menu');

  // Ganti ikon toggle antara 'bx-menu' dan 'bx-x'
  const toggleIcon = navToggle.querySelector('i');
  toggleIcon.classList.toggle('bx-menu');
  toggleIcon.classList.toggle('bx-x');
});

/*===== Menyembunyikan hash (#) section pada alamat web ===== */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();

    const targetId = this.getAttribute('href').substring(1);
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
      targetElement.scrollIntoView({ behavior: 'smooth' });
      history.replaceState(null, null, ' ');
    }
  });
});

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
const sections = document.querySelectorAll('section[id]')

const scrollActive = () =>{
  const scrollDown = window.scrollY

sections.forEach(current =>{
      const sectionHeight = current.offsetHeight,
            sectionTop = current.offsetTop - 58,
            sectionId = current.getAttribute('id'),
            sectionsClass = document.querySelector('.nav__menu a[href*=' + sectionId + ']')

      if(scrollDown > sectionTop && scrollDown <= sectionTop + sectionHeight){
          sectionsClass.classList.add('active-link')
      }else{
          sectionsClass.classList.remove('active-link')
      }
  })
}
window.addEventListener('scroll', scrollActive)

/*===== SCROLL REVEAL ANIMATION =====*/
const sr = ScrollReveal({
  origin: 'top',
  distance: '60px',
  duration: 2000,
  delay: 200,
//     reset: true
});

sr.reveal('.home__data, .home__social-icon, .home__img',{reset: true,});
sr.reveal('.home__data, .about__img, .skills__subtitle, .skills__text',{});
sr.reveal('.home__img, .about__subtitle, .about__text, .skills__img',{delay: 400,});
sr.reveal('.home__social-icon',{ interval: 200,});
sr.reveal('.skills__data, .work__img',{interval: 200,});
sr.reveal('.contact__input, .g-recaptcha, .contact__button',{interval: 200,});
sr.reveal('.contact-right', {
  origin: 'left', // Muncul dari kiri
  distance: '50px', // Jarak pergerakan
  duration: 1500, // Durasi animasi (1 detik)
  delay: 200, // Delay sebelum animasi dimulai
  interval: 200,
  easing: 'ease-out', // Efek easing
  reset: true, // Animasi akan diulang saat elemen muncul kembali
});

/*==================== MODAL & AJAX PAGINATION ====================*/

// Open modal by selector
function openModal(target) {
  const modal = document.querySelector(target);
  const overlay = document.querySelector('.modal-overlay');
  if (!modal) return;
  modal.style.display = 'flex'; // show before animation
  setTimeout(() => modal.classList.add('active'), 10);
  if (overlay) overlay.classList.add('active');
}

// Close currently active modal
function closeModal() {
  const activeModal = document.querySelector('.modal.active');
  const overlay = document.querySelector('.modal-overlay');
  if (!activeModal) return;
  activeModal.classList.remove('active');
  activeModal.classList.add('closing');
  if (overlay) overlay.classList.remove('active');

  const onAnimationEnd = () => {
    activeModal.classList.remove('closing');
    activeModal.style.display = 'none';
    activeModal.removeEventListener('animationend', onAnimationEnd);
  };
  activeModal.addEventListener('animationend', onAnimationEnd, { once: true });
}

// Initialize modal bindings for elements currently in the DOM
function initModals() {
  const portfolioItems = document.querySelectorAll('[data-modal-target]');
  const modals = document.querySelectorAll('.modal');
  const overlay = document.querySelector('.modal-overlay');

  // Bind click for portfolio items (guard with dataset flag to avoid double-binding)
  portfolioItems.forEach(item => {
    if (item.dataset.modalInit) return;
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const target = item.getAttribute('data-modal-target');
      openModal(target);
    });
    item.dataset.modalInit = '1';
  });

  // Bind close buttons inside modals
  modals.forEach(modal => {
    const closeBtn = modal.querySelector('.modal-close');
    if (closeBtn && !closeBtn.dataset.closeInit) {
      closeBtn.addEventListener('click', closeModal);
      closeBtn.dataset.closeInit = '1';
    }
  });

  // Overlay click
  if (overlay && !overlay.dataset.init) {
    overlay.addEventListener('click', closeModal);
    overlay.dataset.init = '1';
  }

  // ESC key (bind once)
  if (!document.body.dataset.modalKeyInit) {
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });
    document.body.dataset.modalKeyInit = '1';
  }
}

// Helper to fetch a partial (lightweight) and replace portfolio markup + modals
async function fetchAndReplacePartial(pageOrUrl) {
  try {
    let url;
    try {
      const maybeUrl = new URL(pageOrUrl, location.origin);
      const params = maybeUrl.search;
      url = `${location.origin}/projects/partial${params}`;
    } catch (_) {
      const pageMatch = String(pageOrUrl).match(/page=(\d+)/);
      if (pageMatch) {
        url = `/projects/partial?page=${encodeURIComponent(pageMatch[1])}`;
      } else if (/^\d+$/.test(String(pageOrUrl))) {
        url = `/projects/partial?page=${encodeURIComponent(pageOrUrl)}`;
      } else {
        url = `/projects/partial`;
      }
    }

    console.debug('[AJAX PAGINATION] fetching partial URL:', url);
    const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-store' });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const html = await res.text();
    console.debug('[AJAX PAGINATION] response length:', html.length);

    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');

    // Try primary selectors, fallback to nested #Portfolio selectors if partial returned full page
    let newContainer = doc.querySelector('.Portfolio__container');
    let newPagination = doc.querySelector('.portfolio-pagination');
    let newModals = doc.querySelectorAll('.modal');

    if (!newContainer) newContainer = doc.querySelector('#Portfolio .Portfolio__container');
    if (!newPagination) newPagination = doc.querySelector('#Portfolio .portfolio-pagination');
    if (!newModals || newModals.length === 0) newModals = doc.querySelectorAll('#Portfolio .modal');

    console.debug('[AJAX PAGINATION] found container:', !!newContainer, 'found pagination:', !!newPagination, 'modals:', newModals.length);

    const currentContainer = document.querySelector('.Portfolio__container');
    const portfolioSection = document.querySelector('#Portfolio');
    const overlay = document.querySelector('.modal-overlay');

    if (newContainer && currentContainer) {
      currentContainer.innerHTML = newContainer.innerHTML;
    } else if (newContainer && !currentContainer && portfolioSection) {
      // insert container if somehow missing
      portfolioSection.insertAdjacentHTML('afterbegin', newContainer.outerHTML);
    }

    // Remove all existing pagination blocks inside #Portfolio, then insert the new pagination once
    if (portfolioSection) {
      portfolioSection.querySelectorAll('.portfolio-pagination').forEach(el => el.remove());
      if (newPagination) {
        // insert HTML to ensure no duplicated nodes
        portfolioSection.insertAdjacentHTML('beforeend', newPagination.outerHTML);
      }
    }

    // Replace modals: remove old modals and insert new ones before overlay
    document.querySelectorAll('.modal').forEach(m => m.remove());
    if (newModals && newModals.length) {
      newModals.forEach(m => {
        const imported = document.importNode(m, true);
        if (overlay && overlay.parentNode) overlay.parentNode.insertBefore(imported, overlay);
      });
    }

    // Re-bind modal event listeners for newly injected content
    initModals();

    return true;
  } catch (err) {
    console.error('Failed to fetch partial:', err);
    return false;
  }
}

// Single pagination click handler: intercept pagination links and load partial via AJAX
document.addEventListener('click', (e) => {
  const anchor = e.target.closest('.portfolio-pagination a');
  if (!anchor) return;
  e.preventDefault();

  const href = anchor.href;
  // extract page number from link href
  let page = '1';
  try {
    const urlObj = new URL(href, location.origin);
    page = urlObj.searchParams.get('page') || '1';
  } catch (_) {
    const m = anchor.getAttribute('href')?.match(/page=(\d+)/);
    if (m) page = m[1];
  }

  // Fetch partial for that href, then push the actual href into history
  fetchAndReplacePartial(href).then((ok) => {
    if (ok) {
      try {
        // store page in history state but keep URL as root to hide partial URL
        history.pushState({ page: page }, '/', '/');
      } catch (err) {
        console.warn('pushState failed', err);
      }
    }
  });
});

// Single popstate handler: fetch the page stored in history.state (default page 1)
window.addEventListener('popstate', (e) => {
  const state = e.state || {};
  const page = state.page || '1';
  fetchAndReplacePartial(page);
});

// Initialize on first load
initModals();

// If the URL contains ?page or ?tool on initial load, fetch the partial and hide the query string by replacing history state with root
(function handleInitialPage() {
  const params = new URLSearchParams(location.search);
  const page = params.get('page');
  const tool = params.get('tool');

  if ((page && page !== '1') || tool) {
    // use the current search to fetch the correct partial
    const search = location.search || '';
    fetchAndReplacePartial(search).then(() => {
      history.replaceState({ page: page || '1', tool: tool || null }, '', '/');
    });
  } else {
    // ensure we have a default state so popstate works
    if (!history.state) history.replaceState({ page: '1' }, '', '/');
  }
})();
