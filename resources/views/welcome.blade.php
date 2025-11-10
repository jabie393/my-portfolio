<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fahd Portfolio</title>
    <link rel="icon" href="{{ asset('images/icons/fcompany.png') }}">

    <!-- Cdn Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Cdn Boxicons Icons -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- Cdn Mailjs -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>


    <style>
        /* Menghilangkan layer biru saat diklik */
        a,
        .nav__toggle,
        .modal-close {
            -webkit-tap-highlight-color: transparent;
            /* Hapus highlight biru */
        }
    </style>
</head>

<!-- Preload -->
<div id="preloader">
    <div class="spinner"></div>
    <div class="progress-text">0%</div>
</div>

<body>
    <!-- HEADER -->
    <header class="l-header">
        <nav class="nav bd-grid">
            <div class="brand">
                <img src="{{ asset('images/icons/fcompany.png') }}" alt="flogo">
                <a class="navlogo" href="#">Fahd39</a>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                    <li class="nav__item"><a href="#aboutme" class="nav__link">About Me</a></li>
                    <li class="nav__item"><a href="#skills" class="nav__link">Skills</a></li>
                    <li class="nav__item"><a href="#Portfolio" class="nav__link">Portfolio</a></li>
                    <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
                    <button class="btn nav__item" type="button" href="#Resume">Resume</button>
                    {{-- Authentication links (Filament-aware) --}}
                    @php
                        use Illuminate\Support\Facades\Auth;
                        use Illuminate\Support\Facades\Route;
                    @endphp

                    <div class="nav__auth">
                        @if (Auth::check())
                            {{-- User is authenticated: link to Filament admin or dashboard --}}
                            <a href="{{ url('/admin') }}" class="nav__link nav__item" title="Dashboard" aria-label="Dashboard">
                                <i class="bi bi-person-circle" aria-hidden="true"></i>
                            </a>
                        @else
                            {{-- Not authenticated: prefer Filament login route if available, else fallback to 'login' or /admin --}}
                            @if (Route::has('filament.auth.login'))
                                <a href="{{ route('filament.auth.login') }}" class="nav__link nav__item" title="Log in" aria-label="Log in">
                                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                                </a>
                            @elseif (Route::has('login'))
                                <a href="{{ route('login') }}" class="nav__link nav__item" title="Log in" aria-label="Log in">
                                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ url('/admin') }}" class="nav__link nav__item" title="Log in" aria-label="Log in">
                                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                                </a>
                            @endif
                        @endif
                    </div>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
        </nav>
    </header>

    <main class="l-main">
        <!-- HOME -->
        <section class="home bd-grid" id="home">
            <div class="home__data">
                <h1 class="home__title">Hai, Saya👋<span class="home__title-color">Fahd</span>.<br>Programmer | Dev</h1>

                <a href="https://wa.me/6283800667908?text=Halo%20min,%20Saya%20tertarik%20dengan%20layanan%20pembuatan%20Aplikasi%20anda!"
                    target="_blank" class="button bi-whatsapp"> Hubungi Saya!</a>
            </div>

            <div class="home__social">
                <a href="https://www.instagram.com/jabie.png')}}/" target="_blank" class="home__social-icon"><i
                        class='bi-instagram'></i></a>
                <a href="https://www.facebook.com/jaby.fahd/" target="_blank" class="home__social-icon"><i
                        class='bi-facebook'></i></a>
                <a href="https://github.com/jabie393/" target="_blank" class="home__social-icon"><i
                        class='bi-github'></i></a>
            </div>

            <div class="home__img">
                <img src="{{ asset('images/me/me1.png')}}" alt="Jaby">
            </div>
        </section>

        <!-- aboutme -->
        <section class="about me section " id="aboutme">
            <h2 class="section-title">About Me</h2>

            <div class="aboutme__container bd-grid">
                <div class="aboutme__img">
                    <img src="{{ asset('images/me/me2.jpg')}}" alt="Jaby">
                </div>
                <div>
                    <h2 class="aboutme__subtitle">Mochammad Fahd Wahyu Rajaby</h2>
                    <p class="aboutme__text">
                        Saya adalah seorang web dan software developer yang memiliki minat besar dalam pengembangan
                        teknologi modern, termasuk aplikasi berbasis web dan mobile. Saat ini, saya sedang menempuh
                        pendidikan S1 di Program Studi Teknik Informatika, Universitas Islam Raden Rahmat (UNIRA).
                    </p>
                    <p class="aboutme__text">
                        Dengan pengalaman dalam merancang dan membangun aplikasi, saya berfokus pada solusi yang
                        inovatif dan sesuai kebutuhan pengguna. Saya juga terus belajar teknologi baru untuk
                        meningkatkan kemampuan saya, khususnya dalam pengembangan aplikasi mobile dan web.
                    </p>
                    <p class="aboutme__text">
                        Jika Anda mencari seorang developer yang berdedikasi, memiliki passion tinggi di bidang
                        teknologi, dan siap bekerja sama untuk menciptakan sesuatu yang luar biasa, jangan ragu untuk
                        menghubungi saya.
                    </p>
                </div>
            </div>
        </section>

        <!-- SKILLS -->
        <section class="skills section" id="skills">
            <h2 class="section-title">Skills</h2>

            <div class="skills__container bd-grid">
                <div>
                    <h2 class="skills__subtitle">Profesional Skills</h2>
                    <p class="skills__text">Saya memiliki keahlian dalam HTML dan CSS untuk membangun tampilan website
                        yang responsif dan menarik. Selain itu, saya menguasai Dart (Flutter) dalam pengembangan
                        aplikasi mobile multiplatform dengan performa tinggi. Pemahaman saya dalam UI/UX Design
                        memungkinkan saya untuk menciptakan antarmuka yang tidak hanya estetis tetapi juga fungsional,
                        memastikan pengalaman pengguna yang optimal. Dengan kombinasi keterampilan ini, saya mampu
                        merancang dan mengembangkan solusi digital yang efektif dan inovatif.</p>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-html5 skills__icon'></i>
                            <span class="skills__name">HTML5</span>
                        </div>
                        <div class="skills__bar skills__html">

                        </div>
                        <div>
                            <span class="skills__percentage">100%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-css3 skills__icon'></i>
                            <span class="skills__name">CSS3</span>
                        </div>
                        <div class="skills__bar skills__css">

                        </div>
                        <div>
                            <span class="skills__percentage">100%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxl-javascript skills__icon'></i>
                            <span class="skills__name">JAVASCRIPT</span>
                        </div>
                        <div class="skills__bar skills__js">

                        </div>
                        <div>
                            <span class="skills__percentage">60%</span>
                        </div>
                    </div>
                    <div class="skills__data">
                        <div class="skills__names">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Dart-logo.png"
                                alt="Dart Logo" class="skills__darticon">
                            <span class="skills__name">DART (Flutter)</span>
                        </div>
                        <div class="skills__bar skills__dart"></div>
                        <div>
                            <span class="skills__percentage">87%</span>
                        </div>
                    </div>

                    <div class="skills__data">
                        <div class="skills__names">
                            <i class='bx bxs-paint skills__icon'></i>
                            <span class="skills__name">UX/UI</span>
                        </div>
                        <div class="skills__bar skills__ux">

                        </div>
                        <div>
                            <span class="skills__percentage">86%</span>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('images/1.jpg')}}" alt="" class="skills__img">
                    <img src="{{ asset('images/2.jpg')}}" alt="" class="skills__img">
                </div>
            </div>
        </section>

        <!-- Portfolio -->
        <section class="Portfolio section" id="Portfolio">
            <h2 class="section-title">Portfolio</h2>

            {{-- include lightweight partial (renders grid, pagination, and modals) --}}
            @include('projects.partial', ['projects' => $projects])

            <!-- Overlay untuk latar belakang gelap -->
            <div class="modal-overlay"></div>
        </section>

        <!-- CONTACT -->
        <section class="contact section" id="contact">
            <h2 class="section-title">Contact</h2>
            <div class="contact__container bd-grid">
                <form id="contactForm" class="contact__form">
                    <input type="text" id="name" placeholder="Nama" class="contact__input">
                    <input type="email" id="email" placeholder="Email" class="contact__input">
                    <textarea id="message" cols="0" rows="10" class="contact__input" placeholder="Pesan"></textarea>

                    <!-- reCAPTCHA Checkbox -->
                    <div class="g-recaptcha-wrapper">
                        <div class="g-recaptcha" data-sitekey="6LceJ8YqAAAAAOmP_-BhmNlZNMS0vndCMmUPK-vB"></div>
                    </div>
                    <button type="button" id="sendEmail" class="contact__button button">Kirim</button>
                </form>
                <div class="contact-right">
                    <h3>Alamat</h3>
                    <div class="contact-info">
                        <div class="info-item">
                            <i class='bi bi-geo-alt-fill'></i>
                            <span>Jl. Tunojoyo, Kec. Gondanglegi, Kab. Malang.</span>
                        </div>
                        <div class="info-item">
                            <i class='bi bi-telephone-fill'></i>
                            <span>+62 858 1200 7371</span>
                        </div>
                        <div class="info-item">
                            <i class='bi bi-envelope-fill'></i>
                            <span>wahyurojabi393@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <ul class="social-links">
                <li><a href="https://github.com/jabie393/" target="_blank"><i class="bi bi-github"></i></a></li>
                <li><a href="https://www.instagram.com/jabie.png')}}/" target="_blank"><i
                            class="bi bi-instagram"></i></a></li>
                <li><a href="https://wa.me/6283800667908?text=Halo%20min,%20Saya%20tertarik%20dengan%20layanan%20pembuatan%20Aplikasi%20anda!"
                        target="_blank"><i class="bi bi-whatsapp"></i></a></li>
                <li><a href="https://www.facebook.com/jaby.fahd/" target="_blank"><i class="bi bi-facebook"></i></a>
                </li>
                <li><a href="https://www.tiktok.com/@flowhybie/" target="_blank"><i class="bi bi-tiktok"></i></a></li>
                <li><a href="https://id.pinterest.com/Flow393/" target="_blank"><i class="bi bi-pinterest"></i></a></li>
            </ul>
            <hr class="custom-hr">
            <div class="footer-content">
                <small>&copy; 2025 Fahd Portfolio. All Rights Reserved.</small>
                <small>Design by <a href="https://www.instagram.com/jabie.png')}}/"
                        target="_blank">@jabie.png'</a>.</small>
            </div>
        </div>
    </footer>

    <!-- SCROLL REVEAL -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- MAIN JS -->
    @vite(['resources/css/welcome.css', 'resources/js/welcome.js'])

    <!-- Emailjs -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <!-- Script reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Script Emailjs & reCAPTCHA -->
    <script>
        emailjs.init('KPYnEToIIXZpXWVgT'); // Public Key

        document.getElementById('sendEmail').addEventListener('click', function () {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            const recaptchaResponse = grecaptcha.getResponse();

            if (!name || !email || !message) {
                alert('Semua bidang harus diisi.');
                return;
            }

            if (!validateEmail(email)) {
                alert('Format email tidak valid.');
                return;
            }

            if (!recaptchaResponse) {
                alert('Silakan centang reCAPTCHA terlebih dahulu.');
                return;
            }

            // Kirim email menggunakan EmailJS
            const templateParams = {
                name: name,
                email: email,
                message: message,
                'g-recaptcha-response': recaptchaResponse, // Tambahkan token reCAPTCHA
            };

            emailjs.send('service_64rrkeq', 'template_bcxqi4u', templateParams)
                .then(function (response) {
                    alert('Email berhasil dikirim!');
                    grecaptcha.reset(); // Reset reCAPTCHA setelah berhasil
                }, function (error) {
                    alert('Terjadi kesalahan: ' + error.text);
                });
        });

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>

</body>

</html>
