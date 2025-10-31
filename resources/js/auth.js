$(document).ready(function () {
    // --- CHARACTER ANIMATIONS ON INPUT FOCUS ---
    $("#email").on("focus", function () {
        $("body").addClass("email-focused").removeClass("password-focused");
    });
    $("#password").on("focus", function () {
        $("body").addClass("password-focused").removeClass("email-focused");
    });
    // When password loses focus, also remove the visible state
    $("#password").on("blur", function () {
        $("body").removeClass("password-visible");
    });
    // Remove classes on clicking outside the form
    $(document).on("click", function (e) {
        if (!$(e.target).closest(".login-form").length) {
            $("body").removeClass(
                "email-focused password-focused password-visible"
            );
        }
    });
    // --- VIEW PASSWORD ICON LOGIC ---
    $(".toggle-password").on("click", function () {
        let passwordInput = $("#password");
        let body = $("body");
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            body.addClass("password-visible");
            $("#eye-open").hide();
            $("#eye-closed").show();
        } else {
            passwordInput.attr("type", "password");
            body.removeClass("password-visible");
            $("#eye-open").show();
            $("#eye-closed").hide();
        }
    });
    // --- EYE TRACKING LOGIC ---
    $(document).on("mousemove", function (event) {
        if ($("body").hasClass("email-focused")) return; // Disable eye tracking in email for simplicity
        let mouseX = event.clientX;
        let mouseY = event.clientY;
        $(".eye").each(function () {
            let eye = $(this);
            let eyeRect = eye[0].getBoundingClientRect();
            let eyeCenterX = eyeRect.left + eyeRect.width / 2;
            let eyeCenterY = eyeRect.top + eyeRect.height / 2;
            let deltaX = mouseX - eyeCenterX;
            let deltaY = mouseY - eyeCenterY;
            let angle = Math.atan2(deltaY, deltaX);
            const radius = eye.width() / 4;
            let pupilX = Math.cos(angle) * radius;
            let pupilY = Math.sin(angle) * radius;
            eye.find(".pupil").css({
                transform: `translate(${pupilX}px, ${pupilY}px)`,
            });
        });
    });
});
