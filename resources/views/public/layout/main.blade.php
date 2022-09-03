@include('public.layout.head')

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->



    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ env('APP_URL') }}pub/assets/images/logo-v3.png" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#services">Services</a></li>
                            <li class="scroll-to-section"><a href="#portfolio">Projects</a></li>
                            <li class="scroll-to-section"><a href="#blog">Blog</a></li>
                            <li class="scroll-to-section"><a href="#contact">Contact</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button"><a href="#contact">Free Quote</a></div>
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6>Digital Media Agency</h6>
                                        <h2>We Boost Your Website Traffic</h2>
                                        <p>This template is brought to you by TemplateMo website. Feel free to use this
                                            for a commercial purpose. You are not allowed to redistribute the template
                                            ZIP file on any other template website. Thank you.</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-first-button scroll-to-section">
                                            <a href="#contact">Free Quote</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ env('APP_URL') }}pub/assets/images/slider-dec-v3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="about-left-image  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ env('APP_URL') }}pub/assets/images/about-dec-v3.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center  wow fadeInRight" data-wow-duration="1s"
                            data-wow-delay="0.5s">
                            <div class="about-right-content">
                                <div class="section-heading">
                                    <h6>About Us</h6>
                                    <h4>Who is DigiMedia <em>Agency</em></h4>
                                    <div class="line-dec"></div>
                                </div>
                                <p>We hope this DigiMedia template is useful for your work. You can use this template
                                    for any purpose. You may <a rel="nofollow" href="http://paypal.me/templatemo"
                                        target="_blank">contribute a little amount</a> via PayPal to <a
                                        href="https://templatemo.com/contact" target="_blank">support TemplateMo</a> in
                                    creating new templates regularly.</p>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item first-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="90">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        90%<br>
                                                        <span>Coding</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item second-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="80">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        80%<br>
                                                        <span>Photoshop</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="skill-item third-skill-item wow fadeIn" data-wow-duration="1s"
                                            data-wow-delay="0s">
                                            <div class="progress" data-percentage="80">
                                                <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <span class="progress-right">
                                                    <span class="progress-bar"></span>
                                                </span>
                                                <div class="progress-value">
                                                    <div>
                                                        80%<br>
                                                        <span>Animation</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Our Services</h6>
                        <h4>What Our Agency <em>Provides</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="menu">
                                        <div class="first-thumb active">
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ env('APP_URL') }}pub/assets/images/service-icon-01.png"
                                                        alt=""></span>
                                                Apartments
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ env('APP_URL') }}pub/assets/images/service-icon-02.png"
                                                        alt=""></span>
                                                Food &amp; Life
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ env('APP_URL') }}pub/assets/images/service-icon-03.png"
                                                        alt=""></span>
                                                Cars
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ env('APP_URL') }}pub/assets/images/service-icon-04.png"
                                                        alt=""></span>
                                                Shopping
                                            </div>
                                        </div>
                                        <div class="last-thumb">
                                            <div class="thumb">
                                                <span class="icon"><img
                                                        src="{{ env('APP_URL') }}pub/assets/images/service-icon-01.png"
                                                        alt=""></span>
                                                Traveling
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col align-self-center">
                                                            <div class="left-text">
                                                                <h4>SEO Analysis &amp; Daily Reports</h4>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="pd-20 card-box mb-30">

                                                                            <div class="card-body">
                                                                                <div
                                                                                    class="d-flex flex-column align-items-center text-center">
                                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                                                        alt="Admin"
                                                                                        class="rounded-circle"
                                                                                        width="150" />
                                                                                    <div class="mt-3">
                                                                                        <h4>{{ $people->name }}</h4>
                                                                                        <p class="text-secondary mb-1">
                                                                                            {{ $people->NIK_employee }}
                                                                                        </p>
                                                                                        <p
                                                                                            class="text-muted font-size-sm">
                                                                                            {{ $people->department }},
                                                                                            {{ $people->position }}
                                                                                        </p>
                                                                                        <button
                                                                                            class="btn btn-primary">Follow</button>
                                                                                        <button
                                                                                            class="btn btn-outline-primary">Message</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="pd-20 card-box">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <h6 class="mb-0">Alamat</h6>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-9 text-secondary">
                                                                                        {{ $people->address }}</div>
                                                                                </div>
                                                                                <hr />
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <h6 class="mb-0">POH</h6>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-9 text-secondary">
                                                                                        {{ $people->group_poh }}, Di {{
                                                                                        $people->poh_place
                                                                                        }}</div>
                                                                                </div>
                                                                                <hr />
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <h6 class="mb-0">Phone</h6>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-9 text-secondary">
                                                                                        {{ $people->phone_number }}
                                                                                    </div>
                                                                                </div>
                                                                                <hr />
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <h6 class="mb-0">Mobile</h6>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-9 text-secondary">
                                                                                        (320) 380-4539</div>
                                                                                </div>
                                                                                <hr />
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <h6 class="mb-0">Address</h6>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-9 text-secondary">
                                                                                        Bay Area, San Francisco, CA
                                                                                    </div>
                                                                                </div>
                                                                                <hr />
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <a class="btn btn-primary"
                                                                                            target="__blank"
                                                                                            href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Healthy Food &amp; Life</h4>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt ut
                                                                    labore et dolore kengan darwin doerski token.
                                                                    dover lipsum lorem and the others.</p>
                                                                <div class="ticks-list"><span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span> <span><i
                                                                            class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span>
                                                                    <span><i class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span> <span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ env('APP_URL') }}pub/assets/images/services-image-02.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Car Re-search &amp; Transport</h4>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt ut
                                                                    labore et dolore kengan darwin doerski token.
                                                                    dover lipsum lorem and the others.</p>
                                                                <div class="ticks-list"><span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span> <span><i
                                                                            class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span>
                                                                    <span><i class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span> <span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ env('APP_URL') }}pub/assets/images/services-image-03.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Online Shopping &amp; Tracking ID</h4>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt ut
                                                                    labore et dolore kengan darwin doerski token.
                                                                    dover lipsum lorem and the others.</p>
                                                                <div class="ticks-list"><span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span> <span><i
                                                                            class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span>
                                                                    <span><i class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span> <span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ env('APP_URL') }}pub/assets/images/services-image-04.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="left-text">
                                                                <h4>Enjoy &amp; Travel</h4>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt ut
                                                                    labore et dolore kengan darwin doerski token.
                                                                    dover lipsum lorem and the others.</p>
                                                                <div class="ticks-list"><span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span> <span><i
                                                                            class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span>
                                                                    <span><i class="fa fa-check"></i> Data Info</span>
                                                                    <span><i class="fa fa-check"></i> SEO
                                                                        Analysis</span> <span><i
                                                                            class="fa fa-check"></i> Optimized
                                                                        Template</span>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                    elit, sedr do eiusmod deis tempor incididunt.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 align-self-center">
                                                            <div class="right-image">
                                                                <img src="{{ env('APP_URL') }}pub/assets/images/services-image.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="free-quote" class="free-quote">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h6>Get Your Free Quote</h6>
                        <h4>Grow With Us Now</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2  wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s">
                    <form id="search" action="#" method="GET">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <fieldset>
                                    <input type="web" name="web" class="website" placeholder="Your website URL..."
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <fieldset>
                                    <input type="address" name="address" class="email" placeholder="Email Address..."
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <fieldset>
                                    <button type="submit" class="main-button">Get Quote Now</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
                        <h6>Our Portofolio</h6>
                        <h4>See Our Recent <em>Projects</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
            <div class="row">
                <div class="col-lg-12">
                    <div class="loop owl-carousel">
                        <div class="item">
                            <a href="#">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="{{ env('APP_URL') }}pub/assets/images/portfolio-01.jpg" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4>Website Builder</h4>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="{{ env('APP_URL') }}pub/assets/images/portfolio-01.jpg" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4>Website Builder</h4>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="{{ env('APP_URL') }}pub/assets/images/portfolio-02.jpg" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4>Website Builder</h4>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="{{ env('APP_URL') }}pub/assets/images/portfolio-03.jpg" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4>Website Builder</h4>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="item">
                            <a href="#">
                                <div class="portfolio-item">
                                    <div class="thumb">
                                        <img src="{{ env('APP_URL') }}pub/assets/images/portfolio-04.jpg" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4>Website Builder</h4>
                                        <span>Marketing</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="section-heading">
                        <h6>Recent News</h6>
                        <h4>Check Our Blog <em>Posts</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-6 show-up wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-post">
                        <div class="thumb">
                            <a href="#"><img src="{{ env('APP_URL') }}pub/assets/images/blog-post-01.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">SEO Analysis</span>
                            <span class="date">03 August 2021</span>
                            <a href="#">
                                <h4>Lorem Ipsum Dolor Sit Amet, Consectetur Adelore
                                    Eiusmod Tempor Incididunt</h4>
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doers itii eiumod deis
                                tempor incididunt ut labore.</p>
                            <span class="author"><img src="{{ env('APP_URL') }}pub/assets/images/author-post.jpg"
                                    alt="">By: Andrea
                                Mentuzi</span>
                            <div class="border-first-button"><a href="#">Discover More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="post-item">
                                    <div class="thumb">
                                        <a href="#"><img src="{{ env('APP_URL') }}pub/assets/images/blog-post-02.jpg"
                                                alt=""></a>
                                    </div>
                                    <div class="right-content">
                                        <span class="category">SEO Analysis</span>
                                        <span class="date">24 September 2021</span>
                                        <a href="#">
                                            <h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4>
                                        </a>
                                        <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="post-item">
                                    <div class="thumb">
                                        <a href="#"><img src="{{ env('APP_URL') }}pub/assets/images/blog-post-03.jpg"
                                                alt=""></a>
                                    </div>
                                    <div class="right-content">
                                        <span class="category">SEO Analysis</span>
                                        <span class="date">24 September 2021</span>
                                        <a href="#">
                                            <h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4>
                                        </a>
                                        <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="post-item last-post-item">
                                    <div class="thumb">
                                        <a href="#"><img src="{{ env('APP_URL') }}pub/assets/images/blog-post-04.jpg"
                                                alt=""></a>
                                    </div>
                                    <div class="right-content">
                                        <span class="category">SEO Analysis</span>
                                        <span class="date">24 September 2021</span>
                                        <a href="#">
                                            <h4>Lorem Ipsum Dolor Sit Amei Eiusmod Tempor</h4>
                                        </a>
                                        <p>Lorem ipsum dolor sit amet, cocteturi adipiscing eliterski.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h6>Contact Us</h6>
                        <h4>Get In Touch With Us <em>Now</em></h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-dec">
                                    <img src="{{ env('APP_URL') }}pub/assets/images/contact-dec-v3.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div id="map">
                                    <iframe
                                        src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        width="100%" height="636px" frameborder="0" style="border:0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="fill-form">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ env('APP_URL') }}pub/assets/images/phone-icon.png"
                                                        alt="">
                                                    <a href="#">010-020-0340</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ env('APP_URL') }}pub/assets/images/email-icon.png"
                                                        alt="">
                                                    <a href="#">our@email.com</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-post">
                                                <div class="icon">
                                                    <img src="{{ env('APP_URL') }}pub/assets/images/location-icon.png"
                                                        alt="">
                                                    <a href="#">123 Rio de Janeiro</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <input type="name" name="name" id="name" placeholder="Name"
                                                    autocomplete="on" required>
                                            </fieldset>
                                            <fieldset>
                                                <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                                    placeholder="Your Email" required="">
                                            </fieldset>
                                            <fieldset>
                                                <input type="subject" name="subject" id="subject" placeholder="Subject"
                                                    autocomplete="on">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <textarea name="message" type="text" class="form-control" id="message"
                                                    placeholder="Message" required=""></textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="main-button ">Send Message
                                                    Now</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2022 DigiMedia Co., Ltd. All Rights Reserved.
                        <br>Design: <a href="https://templatemo.com" target="_parent"
                            title="free css templates">TemplateMo</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ env('APP_URL') }}pub/vendor/jquery/jquery.min.js"></script>
    <script src="{{ env('APP_URL') }}pub/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ env('APP_URL') }}pub/assets/js/owl-carousel.js"></script>
    <script src="{{ env('APP_URL') }}pub/assets/js/animation.js"></script>
    <script src="{{ env('APP_URL') }}pub/assets/js/imagesloaded.js"></script>
    <script src="{{ env('APP_URL') }}pub/assets/js/custom.js"></script>

</body>

</html>