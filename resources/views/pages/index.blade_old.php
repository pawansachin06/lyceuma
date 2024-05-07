<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>

    {{-- slick slider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <header x-data="{showMenu: false, toggleMenu() {this.showMenu = !this.showMenu}}"
        class="py-4 position-fixed top-0 left-0 w-100">
        <nav class="container-fluid d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="">
                    <img src="{{ asset('storage/homepage/logo.png') }}" alt="Logo" class="img-fluid">
                </a>
            </div>
            <div class="menus" :class="{'active' : showMenu}">
                <ul class="list-unstyled d-flex justify-content-center align-items-center gap-4">
                    <li><a class="active" href="">For Institute</a></li>
                    <li><a href="">For Teacher</a></li>
                    <li><a href="">For Student</a></li>
                </ul>
            </div>
            <div class="menu-toggle d-lg-none d-block">
                <button @click="toggleMenu" class="border-0 outline-0 bg-transparent"><i
                        class="fa-solid fa-bars fs-4 bg-white"></i></button>
            </div>
            <div>
                <a class="btn-red">Make Sample Test</a>
            </div>
        </nav>
    </header>

    <div class="hero-section position-relative">
        <div class="hero-banner d-block d-lg-flex justify-content-between container-fluid px-sm-3 px-1 px-lg-5">
            <div class="hero-text z-2 position-relative text-center text-lg-start">
                <h2 class="z-2 position-relative">High Quality, Error-free</h2>
                <h3 class="z-2 position-relative">Digital and Printed Content</h3>
                <h4 class="jee-neet z-2 position-relative">
                    <span class="for">For</span>
                    <span class="jee-neet-text">JEE / NEET</span>
                    <span class="and-sign">&</span>
                    <span class="foundation">Foundation</span>
                </h4>

                <div class="desc z-2 position-relative">
                    <p>Looking for inventive content that is better than those provided by the deep pocketed,
                        “national-chain” institutes?</p>
                </div>

                <div class="sub-desc z-2 position-relative">
                    <p>Your search ends here. We provide end-to-end solutions for all academic content related needs for
                        institute preparing students for Engineering and Medical entrances.</p>
                </div>

            </div>
            <div class="hero-image z-2 position-relative">
                <img src="{{ asset('/storage/homepage/banner-image.svg') }}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="position-absolute bg-image z-1">
            <img src="{{ asset('/storage/homepage/logobg.png') }}" alt="" class="" width="100">
        </div>
    </div>

    <section class="digital-counting">
        <div class="main-wrapper container">
            <div class="content-wrapper">
                <div
                    class="counter-items gap-lg-0 gap-3 d-flex flex-column flex-md-row justify-content-center justify-content-sm-between align-items-center">
                    @for ($i = 1; $i <= 3; $i++) <div class="content content-one d-flex">
                        <img src="{{ asset('/storage/homepage/bank.svg') }}" alt="">
                        <div class="count-content">
                            <span class="counter d-block">350+</span>
                            <span class="title d-block">Institutes served</span>
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </section>



    <section class="our-perfection">
        <div class="wrapper">
            <div class="slider-wrapper">
                @for ($i = 1; $i <= 3; $i++) <div class="content content-1">
                    <div
                        class="container-fluid px-sm-2 px-1 px-lg-5 d-flex flex-lg-row flex-column gap-lg-0 gap-4 justify-content-between">
                        <div class="content-text text-center text-lg-start">
                            <h2 class="heading">Digital Platform with Perfect Synergy of <span class="sub-text"> Online
                                    & Offline Tests</span></h2>
                            <div class="sub-text">
                                <ul>
                                    <li>Make tests of any syllabus in less than 1 minute.</li>
                                    <li>Conduct Tests Online or Offline as per your choice.</li>
                                    <li>Get detailed result analysis of every student with areas of improvement.</li>
                                </ul>
                            </div>
                            <div class="buttons">
                                <a class="make-sample-text btn-red" href="">Make Sample Test</a>
                                <a class="learn-more btn-transparent" href="">Learn More</a>
                            </div>
                        </div>
                        <div class="content-img d-flex justify-content-center">
                            <img src="{{ asset('/storage/homepage/content1.svg') }}" alt="" class="img-fluid">
                        </div>
                    </div>
            </div>
            @endfor

        </div>
    </section>

    <section class="our-digital-offer">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="heading">
                    <h2>Our Digital Offerings</h2>
                </div>
                <div class="row gap-md-0 gap-4">
                    <div class="col-md-7">
                        <div class="video-player px-4">
                            <video id="myVideo" width="100%" class="video__player_shadow" loop="" playsinline=""
                                src="https://eduracle.com/static/media/Our-Digital-Offerings.52d00f9ab1923d8490ac.mp4"
                                controls="">
                            </video>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="contents">
                            <h4>Benefits of Online Platform</h4>
                            <ul>
                                <li>Reduced Cost: With precisely required question papers being generated in few clicks,
                                    almost no efforts are needed to prepare, type, proofread the question papers</li>
                                <li>Our descriptive solutions helps you in doubt solving</li>
                                <li>Separate URL in the name of institute to enhance your brand presence digitally</li>
                                <li>Cutting edge result analysis helps you to guide the students effectively</li>
                                <li>Practically unlimited number of students can give tests</li>
                                <li>Students can give tests from mobile/laptop/desktop/tablet</li>
                                <li>Conduct the same test Online and Offline at the same time</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="esteemed-client">
        <div class="wrapper">
            <div class="container">
                <div class="heading">
                    <h2>Some of our Esteemed Clients</h2>
                </div>
                <div class="contents">
                    <img src="https://eduracle.com/static/media/Eduracle-Map.03e8095854576d53e398.gif" alt=""
                        class="img-fluid">
                </div>
            </div>
        </div>
    </section>


    <section class="our-vision">
        <div class="wrapper">
            <div class="container">
                <div class="contents">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="content-wrapper left-ctn">
                                <h2 class="heading">Our Vision</h2>
                                <div class="content-text">
                                    Increase Efficacy of Learning Cycles
                                    by delivering
                                    <span class="high-quality"> High Quality,</span> <br>
                                    <span class="on-demand">On-Demand Content</span> using
                                    <span class="technology">Technology.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content-wrapper right-ctn">
                                <img src="{{ asset('/storage/homepage/vision.svg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-team">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="heading text-center">
                    <h2>Our Team</h2>
                    <h3 class="sub-heading">With over 25 team members, including 4 IITians and 1 Ph.D., we bring
                        vast education industry expertise.</h3>
                </div>
                <div class="d-flex flex-lg-row flex-column gap-5 m-auto justify-content-center text-center w-100">
                    @for ($i = 1; $i <= 3; $i++) <div class="col-lg-3 col-12">
                        <div class="content-wrapper">
                            <div class="thumb">
                                <img src="{{ asset('/storage/homepage/our-team-1.png') }}" alt=""
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="title">
                                <h4>Abir Bhowmick</h4>
                            </div>
                            <div class="posted">
                                <h4>CEO & Co-founder</h4>
                            </div>
                            <div class="focus">
                                <span class="title">Focus:</span>
                                <span class="name">Product Development</span>
                            </div>
                            <div class="about-us">
                                <ul class="text-center list-unstyled">
                                    <li>Alum of IIT Bombay, 2008 batch</li>
                                    <li>Taught Chemistry for JEE/NEET: 10 years</li>
                                    <li>Co-founded JEE/NEET Institute: 4 years</li>
                                </ul>
                            </div>
                        </div>
                </div>
                @endfor
            </div>
        </div>
        </div>
    </section>


    {{-- <footer>
        <div class="wrapper">
            <div class="row">
                <div class="col-md-3">
                    <div class="wrapper">
                        <a href="">
                            <img src="{{ asset('storage/homepage/logo.png') }}" alt="Logo" class="img-fluid"
                                width="260">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- alpine js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <script>
        $('.slider-wrapper').slick({
            // infinite: true,
            // slidesToShow: 1,
            // slidesToScroll: 1,
            // autoplay: true,
            // autoplaySpeed: 2000,
            arrows: false,
            // dots: true,
            // pauseOnHover: false,
            // pauseOnFocus: false,
            // pauseOnDotsHover: false,
        });

        var video = document.getElementById("myVideo");

    // Mute the video
    video.muted = true;

    // Autoplay the video
    video.autoplay = true;

    // Add an event listener to check when the video can play
    video.addEventListener('canplay', function() {
        // Start playback when the video can play
        video.play();
    });

    </script>
</body>

</html>