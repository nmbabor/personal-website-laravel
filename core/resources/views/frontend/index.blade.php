@extends('frontend.master')

@section('title', 'Home')


@section('hero')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>NM Babor</h1>
            <p>I'm <span class="typed" data-typed-items="Web Designer, Web Developer, Freelancer, Programmer"></span></p>
        </div>
    </section><!-- End Hero -->
@endsection
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title">
                <h2>About</h2>
                <p> I'm <b>NM Babor</b>, a seasoned web application developer with 7 years of professional experience. I
                    began my journey in web development during my 3rd year of Diploma in Engineering. Since joining a
                    company as an intern in 2016, I have been actively involved in working on live projects, refining my
                    skills alongside a talented team. Specializing as a full-stack developer, I have a comprehensive
                    understanding of both front-end and back-end technologies. With expertise in PHP Laravel, MySQL, jQuery,
                    Node.js, React.js, Vue.js, and Express.js, I have successfully delivered a diverse range of web
                    applications. </p>
            </div>

            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <img src="{{ asset('assets/frontend//img/profile-img.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <h3>Key Skills</h3>
                    <p class="fst-italic">
                        A professional full-stack web application developer.
                    </p>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <strong>PHP</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Laravel</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>JavaScript</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>JQuery</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>RESTful API</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>MySQL</strong></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <strong>Node Js</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Vue Js</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>React Js</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Express Js</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Ajax</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>SQL</strong></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                <li><i class="bi bi-chevron-right"></i> <strong>C, C++</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>HTML, CSS</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Bootstrap</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Java(Basic)</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>Git</strong></li>
                                <li><i class="bi bi-chevron-right"></i> <strong>MongoDB</strong></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->



    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
        <div class="container">

            <div class="section-title">
                <h2>Resume</h2>
                <p>
                    I find myself inherently proactive in driving innovation and constructing novel solutions while tackling
                    problems head-on. As a full-stack developer, I am deeply invested in crafting robust system
                    architectures, optimizing performance, and enabling horizontal scaling. I firmly believe in my ability
                    to embrace new challenges and surpass the expectations of my employers.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Education</h3>
                    <div class="resume-item">
                        <h4>BSC</h4>
                        <h5>2021</h5>
                        <p><em>Northern University</em></p>
                        <p>Program: Computer Science & Engineering, Result: Pass</p>
                    </div>
                    <div class="resume-item">
                        <h4>Diploma Engineering</h4>
                        <h5>2015</h5>
                        <p><em>Feni Polytechnic Institute</em> </p>
                        <p><em>Department: Computer Science, Result: Pass</em> </p>
                    </div>
                    <div class="resume-item">
                        <h4>SSC</h4>
                        <h5>2011</h5>
                        <p><em>Noakhali Bangla Bazar High School</em> </p>
                        <p><em>Group: Science, Result: Pass</em> </p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="resume-title">Professional Experience</h3>
                    <div class="resume-item">
                        <h4>Sr. Software Engineer</h4>
                        <h5>2022-12 <i class="bx bxl-arrow"></i> Present</h5>
                        <p><em>Company: Qtec Solution Limited </em></p>
                        <ul>
                            <li>Team Leading, System Analysis</li>
                            <li> Web Application Development</li>
                        </ul>
                    </div>
                    <div class="resume-item">
                        <h4>Sr. Software Engineer</h4>
                        <h5>2018 - 2022-12</h5>
                        <p><em>Company: Applica Systems </em></p>
                        <ul>
                            <li>Team Leading, System Analysis</li>
                            <li> Web Application Development</li>
                        </ul>
                    </div>
                    <div class="resume-item">
                        <h4>Web Application Developer</h4>
                        <h5>2017 - 2018</h5>
                        <p><em>Company: Smart Software Ltd.</em></p>
                        <ul>
                            <li>Team Leading, Application Development, Database Design</li>
                        </ul>
                    </div>
                    <div class="resume-item">
                        <h4>Web Designer & Developer</h4>
                        <h5>2015 - 2017</h5>
                        <p><em>Company: Binary Logic </em></p>
                        <ul>
                            <li>Web Design & Development</li>
                        </ul>
                    </div>
                    
                </div>
            </div>

        </div>
    </section><!-- End Resume Section -->
    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
        <div class="container">

            <div class="section-title">
                <h2>Facts</h2>
                <p>
                    I worked on 40+ Projects in the last 7 years. In this long journey I have worked on many projects, I
                    have worked in a few companies and I have done many personal projects. I have handled many clients.
                    Mainly working with PHP laravel, Mysql, Jquery, Nodejs, ReactJs, VueJs, ExpressJs are mentionable.
                    Completed web based projects are e-commerce, Education management system, Inventory Management, Hospital
                    Management, Event Management, Travel & Tourism, News portal ect.
                </p>
            </div>

            <div class="row no-gutters">

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                    <div class="count-box">
                        <i class="bi bi-emoji-smile"></i>
                        <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Happy Clients</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="count-box">
                        <i class="bi bi-journal-richtext"></i>
                        <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Completed Projects</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
                    <div class="count-box">
                        <i class="bi bi-diamond-half"></i>
                        <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>On Going Projects</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
                    <div class="count-box">
                        <i class="bi bi-people"></i>
                        <span data-purecounter-start="0" data-purecounter-end="130" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Students</strong></p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Usage Technology</h2>
                <p>The ever-evolving demands of both clients and companies have driven me to continually expand my
                    technological knowledge and expertise.</p>
            </div>

            <div class="row skills-content">

                <div class="col-lg-6" data-aos="fade-up">

                    <div class="progress">
                        <span class="skill">PHP <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="90"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">Laravel <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">JavaScript <i class="val">75%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    <div class="progress">
                        <span class="skill">jQuery <i class="val">80%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">Vue JS <i class="val">90%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="progress">
                        <span class="skill">React Js <i class="val">80%</i></span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg" >
        <div class="container">

            <div class="section-title">
                <h2>Portfolio</h2>
                <p>I have completed 40+ projects in the last 7 years. Here are some samples of my project's view, which I
                    and my team have completed. </p>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-1.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-1.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="App 1"><i class="bx bx-search"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-2.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-2.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-3.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-3.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-4.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-4.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-5.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-5.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-6.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-6.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-7.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-7.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-8.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-8.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <div class="portfolio-wrap">
                        <img src="{{ asset('assets/frontend//img/portfolio/portfolio-9.jpg') }}" class="img-fluid"
                            alt="">
                        <div class="portfolio-links">
                            <a href="assets/img/portfolio/portfolio-9.jpg')}}" data-gallery="portfolioGallery"
                                class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title">
                <h2>Services</h2>
                <p> I am committed to delivering my utmost best for every employer I work with. Striving to meet their
                    highest expectations is always my top priority. I take pride in providing top-notch quality service and
                    ensuring that client satisfaction remains at the forefront of my efforts. </p>

            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-file-earmark-richtext"></i></div>
                    <h4 class="title"><a href="">Web Design & Development</a></h4>
                    <p class="description">E-Commerce Website, Organization Website, Personal Website etc.</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon"><i class="bi bi-file-code"></i></div>
                    <h4 class="title"><a href="">Web Application</a></h4>
                    <p class="description">Inventory Management, HR and Accounting Software, Education Management etc.</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon"><i class="bi bi-pencil-square"></i></div>
                    <h4 class="title"><a href="">Customization</a></h4>
                    <p class="description">I provide customized solutions or existing project customization as per needs.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon"><i class="bi bi-stack"></i></div>
                    <h4 class="title"><a href="">Database Design</a></h4>
                    <p class="description">I capable to design the database of websites and web applications in a perfect
                        way.</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon"><i class="bi bi-card-checklist"></i></div>
                    <h4 class="title"><a href="">Project Analysis & Architecture</a></h4>
                    <p class="description">I analyze and create architecture according to the plan for the project before
                        start coding. </p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon"><i class="bi bi-sliders"></i></div>
                    <h4 class="title"><a href="">Server Configuration</a></h4>
                    <p class="description">Configuring the server, running projects on the server, analysis with server
                        security. </p>
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Testimonials</h2>
                <p> I have received valuable feedback and reviews from the individuals I had the privilege to work with, as
                    well as those I have worked for. Their insights and testimonials shed light on my professional
                    capabilities and character. </p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="fade-up">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                He is a very skilled web developer. The finishing of his work is very good. In a few words,
                                he can understand the needs in a project. The boy is a bit lazy, but he can do very quality
                                project in a short time.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('assets/frontend//img/testimonials/asiq.png') }}" class="testimonial-img"
                                alt="">
                            <h3>Asiq Rahman</h3>
                            <h4>Accounts Manager at <b>JHM International DMCC</b> </h4>
                        </div>
                    </div><!-- End testimonial item -->


                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="400">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                I worked with him in my office for 1 year. Worked very well as a team leader in my office.
                                Can easily understand client's needs. Can do things easily by doing project analysis.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('assets/frontend//img/testimonials/sahen.png') }}" class="testimonial-img"
                                alt="">
                            <h3>Shahidul Islam Sahen</h3>
                            <h4>CEO at <b>Smart Software Ltd.</b> </h4>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="400">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                I have worked with him on many projects. A very good developer and can give very good
                                support. He is also good as a trainer. Many boys are working in the programming sector
                                holding his hand.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('assets/frontend//img/testimonials/mohi.png') }}" class="testimonial-img"
                                alt="">
                            <h3>Mohi</h3>
                            <h4>Digital Marketing Expert at <b>Fiverr</b> </h4>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p>To reach out to me for any web-related services, please feel free to contact me via the provided address,
                    email, or mobile number. I am readily available and look forward to assisting you with your specific
                    needs.</p>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>{{readconfig('contact_address')}}</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><a href="mailto:{{readconfig('contact_email')}}">{{readconfig('contact_email')}}</a> </p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p class="no-margin"><a href="tel:{{readconfig('contact_mobile')}}">{{readconfig('contact_mobile')}}</a></p>
                        </div>


                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <iframe
                        src="{{readconfig('google_map')}}"
                        width="100%" height="290" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
