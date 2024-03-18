@extends('layout.layout')

@section('main-content')
    <!-- Seasonal welcome message -->
    <?php
    $dir_name = 'images/seasonal-message/';
    $images = glob($dir_name . '*.jpg');
    foreach ($images as $image) {
        echo '<div class="welcome-message" id="welcome_message">
                  <i class="fa fa-times" id="close_ad" onclick="closeAd()"></i>
                  <img id="welcome_img" src="' .
            $image .
            '" />
                </div>';
    }
    ?>

    <!-- Slider part start from here! -->
    <div class="slider-div">
        <div class="header-slider" id="slider">
            <span class="nav-btn" id="prv-btn"><i class="fa fa-angle-left"></i></span>
            <span class="nav-btn" id="nxt-btn"><i class="fa fa-angle-right"></i></span>
            <div class="slide slide1" onclick="firstSlider()">
                <div id="slide-text1">
                    <h1 id="slide1_h1">If You Can Dream It We Can Make It</h1>
                    <p id="slide1_p">Move Ahead with the power of Data and Analytics</p>
                </div>
            </div>
            <div class="slide slide2" onclick="secondSlider()">
                <div id="slide-text2">
                    <h1 id="slide2_h1">Lets Make Your Business More Efficient With Rouhani</h1>
                    <p id="slide2_p">Move Ahead with the power of Data and Analytics</p>
                </div>
            </div>
            <div class="slide slide3" onclick="thirdSlider()">
                <div id="slide-text3">
                    <h1 id="slide3_h1">Accelerate business growth with Rouhani's development services</h1>
                    <p id="slide3_p">Move Ahead with the power of Data and Analytics</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Main page content start from here! -->
    <section class="main-content">

        <!-- Service area start from here! -->
        <div class="services" id="service">
            <div class="container">
                <h1 data-aos="fade-right">Our Services</h1>
                <p class="sections-p" data-aos="fade-left">We offer a wide range of services from providing customized web
                    development solutions to managing and processing data with the help of modern tools and unleashing the
                    power of analytics in strategic business decisions. Our specialization in handling cargo tracking and
                    delivery related solutions is well established. We have years of experience in the supply chain domain
                    with our clients rating us highly for our commitment and expertise.</p>
                <div class="service-menu">
                    <div class="service-row">
                        <div class="service-content service-content-dark">
                            <div class="read-more-layer layer-dark">
                                <a href="web-development.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth">
                                <img src="{{ asset('website/images/service icons/web development3.png') }}" width="150px">
                                <h5>Web Development</h5>
                                <p>Custom website development to suit the modern business requirement.</p>
                            </div>
                        </div>
                        <div class="service-content service-content-gold">
                            <div class="read-more-layer layer-gold">
                                <a href="data-engineering.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth-gold">
                                <img src="{{ asset('website/images/service icons/data-engineering2.png') }}" width="150px">
                                <h5>Data Engineering</h5>
                                <p>Process, clean and transform data to enable better insights for strategic business
                                    decisions.</p>
                            </div>
                        </div>
                    </div>

                    <div class="service-row">
                        <div class="service-content service-content-gold">
                            <div class="read-more-layer layer-gold">
                                <a href="software-development.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth-gold">
                                <img src="{{ asset('website/images/service icons/software development.png') }}" width="150px">
                                <h5>Software Development</h5>
                                <p>Understand the business requirements to develop user friendly robust solution.</p>
                            </div>
                        </div>
                        <div class="service-content service-content-dark">
                            <div class="read-more-layer layer-dark">
                                <a href="data-analytics.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth">
                                <img src="{{ asset('website/images/service icons/data analytics3.png') }}" width="150px">
                                <h5>Data Analytics</h5>
                                <p>Unleash the power of modern data analytics with state-of-the-art technology.</p>
                            </div>
                        </div>
                    </div>

                    <div class="service-row">
                        <div class="service-content service-content-dark">
                            <div class="read-more-layer layer-dark">
                                <a href="system-training.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth">
                                <img src="{{ asset('website/images/service icons/system training3.png') }}" width="150px">
                                <h5>System Training</h5>
                                <p>Provide on spot and off spot training for your employees to enhance their skills</p>
                            </div>
                        </div>
                        <div class="service-content service-content-gold">
                            <div class="read-more-layer layer-gold">
                                <a href="supply-chain-management.php"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <div class="content-box-oth-gold">
                                <img src="{{ asset('website/images/service icons/scm2.png') }}" width="150px">
                                <h5>Supply Chain Management</h5>
                                <p>Years of experience in handling flow of goods data, and finances</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Us section start from here! -->

        <div class="About_Us" id="about">
            <div class="container">
                <h1 data-aos="fade-left">About Us</h1>
                <p data-aos="fade-right" style="margin-bottom: 50px; font-size: 16px;">Rouhani Insights (P) Ltd is pursuing
                    excellence in the fields of ITES since 2018. Being comparatively new in the ground while having the
                    immense experience of the key persons, gives us the advantage of minimal baggage of a big house along
                    with the wider range of services with precise efficiency. Software solutions, Web solutions, Data
                    analytics, Data Processing, MIS - customize your business need with us and let’s prosper together.</p>
                <div class="row">
                    <div class="col-lg-5 coloum-1" data-aos="fade-right">
                        <div class="owl-about owl-carousel owl-theme">
                            <div class="item">
                                <div class="about-image about-image-3"></div>
                            </div>
                            <div class="item">
                                <div class="about-image about-image-1"></div>
                            </div>
                            <div class="item">
                                <div class="about-image about-image-2"></div>
                            </div>
                            <div class="item">
                                <div class="about-image about-image-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 coloum-2" data-aos="fade-left">
                        <ul>
                            <li><i class="fa fa-check-circle"></i>
                                <p>We offer a wide range of custom website development services.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Our competent developers and programmers use fundamental programming languages and
                                    frameworks, to create web apps that are highly scalable, secure, and optimized for
                                    exceptional user experiences.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Offering customized and enterprise-level ecommerce web solutions using the latest tools
                                    and technologies.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Gather business insights with a robust data foundation, modernization, and platform
                                    management.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>We work with cutting edge technologies for data processing and using the latest ETL tools
                                    to process, clean and present data.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Interpret data, analyzing results using statistical techniques.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Developing and implementing data analyses, data collection systems and other strategies
                                    that optimize statistical efficiency and quality.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Using automated tools to extract data from primary and secondary sources.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Removing corrupted data and fixing bugs related problems.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 coloum-mobile">
                        <img src="images/office-inside.jpg" class="oth-img-mobile">
                    </div>
                    <div class="col-lg-6 coloum-2" data-aos="fade-left">
                        <ul>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Developing and maintaining databases, and data systems – reorganizing data in a readable
                                    format.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Performing analysis to assess the quality and meaning of data.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Filter Data by reviewing reports and performance indicators to identify and correct code
                                    problems.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>Years of combined experience on supply chain management, digital automation
                                    customization, quality control management.</p>
                            </li>
                            <li><i class="fa fa-check-circle"></i>
                                <p>We specialize in international Cargo tracking & delivery related solutions. We provide
                                    world class Subject Matter Expertise for Cargo Booking, EDI Tracking, Rate Auditing,
                                    Carrier Billing, Roll Over Tracking, Contract Management and much more to create and
                                    maintain supply chain solutions across the Globe.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-5 coloum-3" data-aos="fade-right">
                        <div class="about-image-div-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tools part start from here! -->

        <div class="tools">
            <h3>Key Strength & Expertise</h3>
            <div class="logo">
                <div class="bootstrap"><img src="images/tools/bootstrap.png" alt=""></div>
                <div class="css"><img src="images/tools/css.png" alt=""></div>
                <div class="html"><img src="images/tools/html.png" alt=""></div>
                <div class="informatica"><img src="images/tools/informatica.png" alt=""></div>
                <div class="jquery"><img src="images/tools/jquery.png" alt=""></div>
                <div class="js"><img src="images/tools/js.png" alt=""></div>
                <div class="laravel"><img src="images/tools/laravel.png" alt=""></div>
                <div class="mongo"><img src="images/tools/mongo db.png" alt=""></div>
                <div class="mysql"><img src="images/tools/mysql.png" alt=""></div>
                <div class="php"><img src="images/tools/php.png" alt=""></div>
                <div class="plsql"><img src="images/tools/plsql.png" alt=""></div>
                <div class="poewr"><img src="images/tools/poewr.png" alt=""></div>
                <div class="python"><img src="images/tools/python.png" alt=""></div>
                <div class="sql"><img src="images/tools/sql.png" alt=""></div>
                <div class="tableau"><img src="images/tools/tableau.jpg" alt=""></div>
            </div>
        </div>

        <!-- Testimonials part start from here! -->

        <!-- <div class="testimonials" id="testimonial">
        <div class="container">
          <h2>Testimonials</h2>
          <div class="owl-testi owl-carousel owl-theme">
            <div class="item">
              <img src="images/team/suman.jpeg">
              <div class="testi-content">
                <p><i>"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea sunt hic aliquam ipsa temporibus numquam officiis illum"</i></p>
                <h5>Suman Debnath</h5>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half"></i>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="images/team/pranoy.jpeg">
              <div class="testi-content">
                <p><i>"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea sunt hic aliquam ipsa temporibus numquam officiis illum"</i></p>
                <h5>Pranoy Singha</h5>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              </div>
            </div>
            <div class="item">
              <img src="images/team/arnab.jpeg">
              <div class="testi-content">
                <p><i>"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea sunt hic aliquam ipsa temporibus numquam officiis illum"</i></p>
                <h5>Arnab Banerjee</h5>
                <div class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

        <!-- Teams part start from here! -->

        <div class="team" id="team">
            <div class="container">
                <h1 data-aos="fade-right">Meet Our Team</h1>
                <p data-aos="fade-left">Our team is small but don’t go by the size. We are just dynamic enough to give you
                    the solution you are looking for. We are a bunch of serious looking but fun loving workaholic.</p>
                <div class="row">
                    <div class="col-sm-6" data-aos="zoom-in">
                        <div class="members-dir">
                            <div class="member-img-link">
                                <img src="images/team/rouhin.jpg" class="member-img">
                                <a href="https://www.linkedin.com/in/rouhin-banerjee-301285253/" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Rouhin Banerjee</h5>
                                <p>Director Operations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" data-aos="zoom-in">
                        <div class="members-dir">
                            <div class="member-img-link">
                                <img src="images/team/anisur.jpeg" class="member-img">
                                <a href="https://www.linkedin.com/in/anisur-rahman-75a6b124b/" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Anisur Rahman</h5>
                                <p>Director Technical</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-sm-6 col-lg-2" data-aos="zoom-in">
                        <div class="members">
                            <div class="member-img-link">
                                <img src="images/team/arnab.jpeg" class="member-img">
                                <a href="https://www.linkedin.com/in/arnab-banerjee-0b54b2156/" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Arnab Banerjee</h5>
                                <p>Data Engineer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2" data-aos="zoom-in">
                        <div class="members">
                            <div class="member-img-link">
                                <img src="images/team/somu.JPG" class="member-img">
                                <a href="https://www.linkedin.com/in/somdeb-banerjee-947732118/" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Somdeb Banerjee</h5>
                                <p>Data Anaylyst</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-2" data-aos="zoom-in">
                        <div class="members">
                            <div class="member-img-link">
                                <img src="images/team/pupai.JPG" class="member-img">
                                <a href="https://www.linkedin.com/in/pratim-ganguly-482499234" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Pratim Ganguly</h5>
                                <p>Data Anaylyst</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-2" data-aos="zoom-in">
                        <div class="members">
                            <div class="member-img-link">
                                <img src="images/team/suman.JPG" class="member-img">
                                <a href="https://www.linkedin.com/in/suman-debnath-ab7647237/" target="_blank">
                                    <h3>Linked</h3><i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="member-details">
                                <h5>Suman Debnath</h5>
                                <p>Web Developer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-2" data-aos="zoom-in">
                        <div class="members">
                            <div class="member-img-link">
                                <img src="images/team/pranoy.jpeg" class="member-img">
                                <a href="https://www.linkedin.com/in/pranoy-singha-5766b2211" target="_blank"><i
                                        class="fab fa-linkedin"></i></a>
                            </div>
                            <div class="member-details">
                                <h5>Pranoy Singha</h5>
                                <p>Web Developer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partners part start from here! -->

        <div class="partners" id="associate">
            <div class="owl-partners owl-carousel owl-theme">
                <div class="item"><a href="#"><img src="images/partner/gemini-shippers-group-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/hapag-lloyd-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/one-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/hmm-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/oocl-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/zim-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/cosco-logo.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/f&p.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/cognico.png"></a></div>
                <div class="item"><a href="#"><img src="images/partner/ihq.png"></a></div>
            </div>
        </div>

        <!-- Contact us part start from here! -->

        <div class="contact-us" id="contact">
            <div class="bar">
                <div class="bar1" id="bar1"></div>
                <div class="bar2" id="bar2"></div>
            </div>
            <div class="bar-1">
                <div class="bar1-1" id="bar1-1"></div>
                <div class="bar1-2" id="bar1-2"></div>
            </div>
            <div class="container">
                <h1 data-aos="zoom-in">Contact Us</h1>
                <p>Do you have a project to discuss with us ? We will get back to you as soon as possible</p>
                <!-- <div class="row"> -->
                <!-- <div class="contact-details col">
              <div class="contact-info" data-aos="fade-right">
                <i class="fa fa-map"></i>
                <div class="contact-sub">
                  <h5>Address:</h5>
                  <p>DN 10,Sector-V, Saltlake, Kolkata-700091</p>
                </div>
              </div>
              <div class="contact-info" data-aos="fade-right">
                <i class="fa fa-envelope"></i>
                <div class="contact-sub">
                  <h5>Email:</h5>
                  <p>info@rouhaniinsights.com</p>
                </div>
              </div>
              <div class="contact-info" data-aos="fade-right">
                <i class="fa fa-phone"></i>
                <div class="contact-sub">
                  <h5>Phone:</h5>
                  <p>+91-33-48040713</p>
                </div>
              </div>
            </div> -->
                <div class="contact-form" data-aos="fade-down">
                    <form action="" method="post" id="myForm">
                        <div class="contact-us-index-sub-div">
                            <input class="input-name" id="input-name" type="text" placeholder="Your Name"
                                name="name" onkeyup="return validateName()">
                            <input class="input-email" id="input-email" type="email" placeholder="Your Email"
                                name="email" onkeyup="return validateEmail()">
                        </div>
                        <!-- <input class="input-subject" id="input-subject" type="text" placeholder="Subject" name="subject" onkeyup="return validateSubject()">
                <textarea class="input-message" cols="30" rows="5" name="message" placeholder="Message"></textarea> -->
                        <button class="submit-btn-index" type="submit" name="esubmit"
                            onclick="return validateForm()">Send Message</button>
                    </form>
                    <p id="error-show" style="color:red"></p>
                    <?php
                    if (isset($_POST['esubmit'])) {
                        $to = 'info@rouhaniinsights.com';
                        $subject = 'This is a query mail from ' . ucfirst($_POST['name']);
                        $name = $_POST['name'];
                        $message = 'Name: ' . $name . "\n" . 'Email: ' . $_POST['email'] . "\n" . 'Message: ' . ucfirst($name) . 'try to contact us.';
                        $from = $_POST['email'];
                        $headers = "From: $from";
                    
                        $mail = mail($to, $subject, $message, $headers);
                    
                        if ($mail == true) {
                            echo '<script>alert("Mail sent successfully");</script>';
                            echo "<script>window.location = 'index.php';</script>";
                        } else {
                            echo '<p style="color:red">Mali not sent! Something is wrong!</p>';
                        }
                    }
                    ?>
                </div>
                <!-- </div> -->
            </div>
        </div>

        <!-- Company Brochure -->

        <div class="brochure-box">
            <div class="row justify-content-evenly">
                <div class="brochure col-md-6 mt-5 mb-5" data-aos="fade-up">
                    <a href="downloads/Rouhani Brochure Small.pdf" target="_blank">
                        <div class="brochure-i">
                            <i class="fa fa-book"></i>
                        </div>
                    </a>
                    <h5>Read Our Brochure Here!</h5>
                </div>
                <div class="brochure col-md-6 mt-5 mb-5" data-aos="fade-down">
                    <a href="downloads/Rouhani Brochure Small.pdf" download="Rouhani Brochure Small.pdf">
                        <div class="brochure-i">
                            <i class="fa fa-arrow-down"></i>
                        </div>
                    </a>
                    <h5>Download Our Brochure Here!</h5>
                </div>
            </div>
        </div>
    </section>
@endsection
