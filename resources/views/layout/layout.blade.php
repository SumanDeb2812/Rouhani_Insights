<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('website/images/favicon.png') }}">

    <!-- Style sheet link below! -->
    <link rel="stylesheet" href="{{ asset('website/scss/style.css') }}">

    <!-- Google font link below! -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap css link below! -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Owl carousel css file link below! -->
    <link rel="stylesheet" href="{{ asset('website/owl-carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('website/owl-carousel/css/owl.theme.default.css') }}">

    <!-- Animation.css link below! -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Animation on scroll -->
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->

    <!-- Font awsome icon link below! -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Rouhani Insights Pvt. Ltd.</title>
    <!-- It is a official website of an indian conpany name Rouhani Insights Pvt. Ltd. which formed on 2019, 4th January by Rouhin Banerjee and Anisur Rahaman. This company has worked on Information Tecnology, Supply Chain Management, Data Engineering and Web Devolopment. -->

    <meta name="description"
        content="We offer a wide range of services from providing customized web development solutions to Data analytics. We have years of experience in the supply chain domain with worldwide clients, acknowledging our expertise in these fields.">
</head>

<body>

    <!-- Preloader area -->
    <div class="preloader" id="preloader"></div>

    <!--scroll to top area -->
    <a href="#top">
        <div class="scrollToTop" id="scrollToTop"><i class="fa fa-angle-up"></i></div>
    </a>

    <!-- Header area start from here! -->

    <section class="header" id="home">

        <!-- Navbar part start from here! -->

        <nav id="navbar">
            <div class="logo-div" id="logo-div">
                <img src="{{ asset('website/images/logo2.png') }}" alt="">
            </div>
            <img src="{{ asset('website/images/favicon.png') }}" alt="" id="logo-small">
            <div class="navlist" id="collapsable_nav">
                <i class="fa fa-times" id="close_menu" onclick="closeMenu()"></i>
                <ul id="nav-ul">
                    <li><a href="#service">Services</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="newsfeed.php">Blogs</a></li>
                    <li><a href="project-competency.php">Projects</a></li>
                </ul>
            </div>
            <div class="logo-div-2" id=".logo-div-2">
                <a href="https://www.linkedin.com/company/scm-data-insights/" target="_blank"><i
                        class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/profile.php?id=100078485900651" target="_blank"><i
                        class="fab fa-facebook-square"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="https://instagram.com/scm_data_insights?igshid=NTc4MTIwNjQ2YQ==" target="_blank"><i
                        class="fab fa-instagram"></i></a>
            </div>
            <i class="fa fa-bars" id="open_menu" onclick="openMenu()"></i>
        </nav>

        @yield('main-content')

        <!-- Footer area start from here! -->
        <section class="footer">
            <div class="container container-footer">
                <div class="footerdiv footer-contactdetails" data-aos="fade-left">
                    <h5>Contact Info</h5>
                    <p>Rouhani Insights Pvt. Ltd.<br>
                        Merlin Matrix, 4th Floor, Room No - 403 <br>
                        DN 10, Sector-V, Saltlake <br> Kolkata - 700091</p>
                    <p><b>Phone:</b> +91-33-48040713<br>
                        <b>Email:</b> info@rouhaniinsights.com
                    </p>
                </div>
                <div class="sub-footer">
                    <div class=" footerdiv footer-usefullinks" data-aos="fade-up">
                        <h5>Useful Links</h5>
                        <div class="usefullinks">
                            <ul>
                                <li><a href="#">Gemini Shippers</a></li>
                                <li><a href="#">Notice and Updates</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Carriers</a></li>
                                <li><a href="#">Upload</a></li>
                                <li><a href="{{ url('login') }}">My Rouhani</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footerdiv footer-ourservices" data-aos="fade-down">
                        <h5>Our Services</h5>
                        <div class="ourservices">
                            <ul>
                                <li><a href="web-development.php">Web Development</a></li>
                                <li><a href="data-engineering.php">Data Engineering</a></li>
                                <li><a href="software-development.php">Software Devolopment</a></li>
                                <li><a href="data-analytics.php">Data Analytics</a></li>
                                <li><a href="system-training.php">System Traning</a></li>
                                <li><a href="supply-chain-management.php">Supply Chain Management</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footerdiv footer-aboutcompany" data-aos="fade-right">
                    <a href="#home">
                        <h5>Rouhani Insights Pvt. Ltd.</h5>
                    </a>
                    <div class="social">
                        <a href="https://www.linkedin.com/company/scm-data-insights/" target="_blank"><i
                                class="fab fa-linkedin" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100078485900651" target="_blank"><i
                                class="fab fa-facebook" aria-hidden="true"></i></a>
                        <a href="https://instagram.com/scm_data_insights?igshid=NTc4MTIwNjQ2YQ==" target="_blank"><i
                                class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="copyright">
            <p>Copyright © 2023 RouhAni Insights Pvt. Ltd.</p>
        </section>

        <!-- Main js file link below! -->
        <script src="{{ asset('website/js/main.js') }}"></script>
        <script src="{{ asset('website/js/form-validation.js') }}"></script>

        <!-- Bootstrap js link below -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Owl cerousel js file and jquery file link below! -->
        <script src="{{ asset('website/owl-carousel/js/jquery.min.js') }}"></script>
        <script src="{{ asset('website/owl-carousel/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('website/owl-carousel/js/script.js') }}"></script>

        <!-- Animation on scroll -->
        <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 50,
        delay: 200,
        duration: 1000,
    });
    // You can also pass an optional settings object
    // below listed default settings
    // AOS.init({
    //   // Global settings:
    //   disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    //   startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    //   initClassName: 'aos-init', // class applied after initialization
    //   animatedClassName: 'aos-animate', // class applied on animation
    //   useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    //   disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    //   debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    //   throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

    //   // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    //   offset: 120, // offset (in px) from the original trigger point
    //   delay: 0, // values from 0 to 3000, with step 50ms
    //   duration: 400, // values from 0 to 3000, with step 50ms
    //   easing: 'ease', // default easing for AOS animations
    //   once: false, // whether animation should happen only once - while scrolling down
    //   mirror: false, // whether elements should animate out while scrolling past them
    //   anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
    // });
</script> -->

        <script>
            //Preloader function
            var preloader = document.getElementById('preloader');
            window.addEventListener('load', function() {
                preloader.style.display = 'none';
            });
        </script>

</body>

</html>
