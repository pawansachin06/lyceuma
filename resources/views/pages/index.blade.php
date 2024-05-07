<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>

    {{-- slick slider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" />

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    @vite('resources/css/app.scss')

</head>

<body>
    <header x-data="{showMenu: false, toggleMenu() {this.showMenu = !this.showMenu}}"
        class="py-4 fixed top-0 left-0 w-full">
        <nav class="px-2 sm:px-5 2xl:px-40 flex justify-between items-center">
            <div class="logo">
                <a href="">
                    <img src="{{ asset('img/homepage/logo.png') }}" alt="Logo" class="img-fluid">
                </a>
            </div>
            <div class="menus" :class="{'active' : showMenu}">
                <ul class="flex justify-center items-center gap-x-[30px]">
                    <li><a class="active" href="">For Institute</a></li>
                    <li><a href="">For Teacher</a></li>
                    <li><a href="">For Student</a></li>
                </ul>
            </div>
            <div class="menu-toggle lg:hidden block">
                <button @click="toggleMenu" class="border-none outline-none bg-transparent"><i
                        class="fa-solid fa-bars text-4 bg-white"></i></button>
            </div>
            <div>
                <a
                    class="btn-red bg-[#e72c25] text-white font-[600] text-[12px] sm:text-[18px] p-[8px_30px] border-0.5 border-solid border-[#e72c25] rounded-1 transition-all duration-300 no-underline inline-block hover:bg-[#212529] hover:border-[#212529]">Make
                    Sample Test</a>
            </div>
        </nav>
    </header>


    <section class="hero-section relative mt-[7rem] md:mt-[10rem]">
        <div class="wrapper px-2 sm:px-5 md:px-20 2xl:px-40 ">
            <div
                class="hero-banner grid lg:grid-cols-[60%_auto] grid-cols-1 justify-start">
                <div class="hero-text z-20 relative text-center lg:text-start">
                    <h2 class="z-20 relative text-[22px] md:text-[35px]">High Quality, Error-free</h2>
                    <h3 class="z-20 relative text-[27px] md:text-[43px] font-[700]">Digital and Printed Content</h3>
                    <h4 class="jee-neet z-20 relative text-transparent text-[20px] md:text-[27px] mb-[2.7rem] font-[600]">
                        <span class="for text-[#232323]">For</span>
                        <span class="jee-neet-text text-[#e82920]">JEE / NEET</span>
                        <span class="and-sign text-[#232323]">&</span>
                        <span class="foundation text-[#0538bc]">Foundation</span>
                    </h4>

                    <div class="desc z-20 relative">
                        <p class="text-[#4d4d4d] font-[400] text-[16px] md:text-[20px]">Looking for inventive content that is better than those provided by the deep pocketed,
                            “national-chain” institutes?</p>
                    </div>

                    <div class="sub-desc z-20 relative">
                        <p class="font-[400] text-[#232323] text-[14px]">Your search ends here. We provide end-to-end solutions for all academic content related needs
                            for
                            institute preparing students for Engineering and Medical entrances.</p>
                    </div>

                </div>
                <div class="hero-image mt-[2rem] text-center lg:mt-0 z-20 relative">
                    <img src="{{ asset('/img/homepage/banner-image.svg') }}" alt="" class="w-full max-w-full">
                </div>
            </div>
            <div class="absolute bg-image z-10 top-[10%] left-[-50px]">
                <img src="{{ asset('/img/homepage/logobg.png') }}" alt="" class="" width="100">
            </div>
        </div>
    </section>


    <section class="digital-counting bg-[#faf8f8] py-[1rem]">
        <div class="main-wrapper container mx-auto px-2 sm:px-5 md:px-20 2xl:px-0">
            <div class="content-wrapper">
                <div class="counter-items flex flex-col md:flex-row justify-center md:justify-between items-center">
                    @for ($i = 1; $i <= 3; $i++) <div class="content content-one flex gap-[20px]">
                        <img src="{{ asset('/img/homepage/bank.svg') }}" alt="">
                        <div class="count-content">
                            <span class="counter block text-[#232323] text-[22px] font-[700]">350+</span>
                            <span class="title block text-[#848484] text-[14px]">Institutes served</span>
                        </div>
                </div>
                @endfor
            </div>
        </div>
    </section>


    <section class="our-perfection mt-10">
        <div class="wrapper">
            <div class="slider-wrapper">
                @for ($i = 1; $i <= 3; $i++) <div class="content bg-[#eafee8] content-1 py-10 md:py-20">
                    <div
                        class="px-2 sm:px-5 md:px-20 2xl:px-40 grid lg:grid-cols-[70%_auto] grid-cols-1 justify-between">
                        <div class="content-text">
                            <h2
                                class="heading md:text-[42px] md:leading-[60px] text-7 leading-8 font-[700] text-[#232323] mb-4 text-center lg:text-start">
                                Digital Platform with Perfect Synergy of <span
                                    class="sub-text text-[#e82920] font-[700]"> Online
                                    & Offline Tests</span></h2>
                            <div class="sub-text mb-8">
                                <ul class="pl-[2rem] md:pl-[5rem] text-[#232323]">
                                    <li class="font-[400] text-[16px] lg:text-[20px] leading-8 lg:leading-10">Make tests
                                        of any syllabus in less than 1 minute.</li>
                                    <li class="font-[400] text-[16px] lg:text-[20px] leading-8 lg:leading-10">Conduct
                                        Tests Online or Offline as per your choice.</li>
                                    <li class="font-[400] text-[16px] lg:text-[20px] leading-8 lg:leading-10">Get
                                        detailed result analysis of every student with areas of improvement.</li>
                                </ul>
                            </div>
                            <div class="buttons">
                                <a class="make-sample-text bg-[#e72c25] text-white font-[600] text-[12px] sm:text-[18px] p-[8px_30px] border-0.5 border-solid border-[#e72c25] rounded-1 transition-all duration-300 no-underline inline-block hover:bg-[#212529] hover:border-[#212529]"
                                    href="">Make Sample Test</a>
                                <a class="learn-more bg-transparent  text-[#e72c25] font-[600] text-[12px] sm:text-[18px]  p-[8px_30px] border-0.5 border-solid border-[#e72c25] rounded-1 transition-all duration-300 no-underline inline-block hover:bg-[#e72c25] hover:border-[#e72c25] hover:text-white"
                                    href="">Learn More</a>
                            </div>
                        </div>
                        <div class="content-img flex justify-center">
                            <img src="{{ asset('/img/homepage/content1.svg') }}" alt="" class="max-w-full w-full">
                        </div>
                    </div>
            </div>
            @endfor

        </div>
    </section>


    <section class="our-digital-offer bg-[#fbf8f8] py-7">
        <div class="wrapper">
            <div class="px-2 sm:px-5 md:px-20 2xl:px-40">
                <div class="heading mb-[30px]">
                    <h2 class="text-[28px] md:text-[38px] text-[#232323] text-center font-[700]">Our Digital Offerings
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-md-7">
                        <div class="video-player px-4">
                            <video class="shadow-[0px_.5rem_1rem_rgba(0,0,0,.15)]" id="myVideo" width="100%"
                                class="video__player_shadow" loop="" playsinline=""
                                src="https://eduracle.com/static/media/Our-Digital-Offerings.52d00f9ab1923d8490ac.mp4"
                                controls="">
                            </video>
                        </div>
                    </div>
                    <div class="">
                        <div class="contents">
                            <h4 class="text-[20] font-[700] mb-[20px]">Benefits of Online Platform</h4>
                            <ul class="flex flex-col gap-y-[10px] text-[14px]">
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

    <section class="esteemed-client bg-[rgb(251,251,251)] py-[2rem]">
        <div class="wrapper container mx-auto px-2 sm:px-5 md:px-20 2xl:px-0">
            <div class="container">
                <div class="heading mb-[30px]">
                    <h2 class="text-[28px] md:text-[38px] text-[#232323] font-[700] text-center">Some of our Esteemed
                        Clients</h2>
                </div>
                <div class="contents">
                    <img src="https://eduracle.com/static/media/Eduracle-Map.03e8095854576d53e398.gif" alt=""
                        class="w-full max-w-full">
                </div>
            </div>
        </div>
    </section>


    <section class="our-vision py-[3rem] bg-[#fbf7ed]">
        <div class="wrapper px-2 sm:px-5 md:px-20 2xl:px-40">
            <div class="container">
                <div class="contents">
                    <div class="grid grid-cols-1 lg:grid-cols-2 justify-between items-center gap-5">
                        <div class="content-wrapper left-ctn">
                            <h2 class="heading font-[700] text-[2rem] mb-[30px]">Our Vision</h2>
                            <div
                                class="content-text font-[500] text-[18px] md:text-[22px] text-[#232323] leading-[40px]">
                                Increase Efficacy of Learning Cycles
                                by delivering
                                <span class="high-quality text-[#0538bc] font-[700]"> High Quality,</span> <br>
                                <span class="on-demand text-[#0538bc] inline-block font-[700]">On-Demand Content</span>
                                using
                                <span class="technology">Technology.</span>
                            </div>
                        </div>
                        <div class="content-wrapper right-ctn">
                            <img src="{{ asset('/img/homepage/vision.svg') }}" alt="" class="w-full max-w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-team mt-[2rem] py-[2rem]">
        <div class="wrapper px-2 sm:px-5 md:px-20 2xl:px-40">
            <div class="container-fluid">
                <div class="heading text-center mb-[30px]">
                    <h2 class="heading text-[28px] md:text-[38px] text-[#232323] font-[700]">Our Team</h2>
                    <h3 class="sub-heading text-[#6b6b6b] text-[1rem] leading-[28px] font-[400] max-w-[50%] mx-auto">
                        With over 25 team members, including 4 IITians and 1 Ph.D., we bring
                        vast education industry expertise.</h3>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-[28%_28%_28%] mx-auto gap-5  justify-center text-center">
                    @for ($i = 1; $i <= 3; $i++) <div class="w-auto">
                        <div class="content-wrapper">
                            <div class="thumb mb-2.5">
                                <img src="{{ asset('/img/homepage/our-team-1.png') }}" alt=""
                                    class="max-w-[180px] w-full rounded-[50%]">
                            </div>
                            <div class="title mb-2">
                                <h4 class="font-[700] text-[19px]">Abir Bhowmick</h4>
                            </div>
                            <div class="posted mb-[10px]">
                                <h4 class=" text-[14px] text-[#0538bc] font-[700]">CEO & Co-founder</h4>
                            </div>
                            <div class="focus mb-6">
                                <span class="title text-[13px] font-[500] text-[#000]">Focus:</span>
                                <span class="name text-[14px] text-[#e82920] font-[700]">Product Development</span>
                            </div>
                            <div class="about-us">
                                <ul
                                    class="flex flex-col items-center w-auto text-[13px] leading-[28px] text-[#000] font-[500]">
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


    <footer
        class="bg-[url('data:image/png;base64,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')] bg-no-repeat bg-cover">
        <div class="footer-wrapper px-2 sm:px-5 md:px-20 2xl:px-40 py-[2rem]">
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-y-[30px]">
                <div class="logo-section lg:col-span-1 col-span-full lg:text-start text-center">
                    <a href="">
                        <img src="{{ asset('img/homepage/logo.png') }}" alt="Logo" class="img-fluid" width="260">
                    </a>
                </div>
                <div class="menu-1 lg:text-start text-center">
                    <ul class="list-none flex flex-col gap-y-3">
                        <li><a class="no-underline text-red-500" href="">For Institute</a></li>
                        <li><a class="no-underline text-red-400" href="">For Teacher</a></li>
                        <li><a class="no-underline text-red-400" href="">For Student</a></li>
                        <li><a class="no-underline text-red-400" href="">Contact Us</a></li>
                        <li><a class="no-underline text-red-400" href="">Terms of Services</a></li>
                        <li><a class="no-underline text-red-400" href="">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="address text-center lg:text-start">
                    <div class="wrapper flex flex-row gap-x-[20px] lg:justify-start justify-center">
                        <div>
                            <img src="{{asset('img/homepage/location.svg')}}" alt="">
                        </div>
                        <p>
                            721, 7th Floor,<br>
                            East Wing West Side,<br>
                            Marigold Premises,<br>
                            Kalyani Nagar,<br>
                            Pune 411014<br>
                        </p>
                    </div>
                </div>

                <div class="social-links lg:text-start text-center">
                    <div class="wrapper flex flex-col gap-y-3">
                        <div>
                            <a class="no-underline text-red-500" href="tel:+919191xxxxxx">
                                <img src="{{asset('img/homepage/call.svg')}}" alt="" class="pr-2">
                                +91 9191919191
                            </a>
                        </div>
                        <div class="email">
                            <a class="no-underline text-red-500" href="mailto:hello@eduracle.com">
                                <img src="{{asset('img/homepage/mail.svg')}}" alt="" class="pr-2">
                                hello@eduracle.com
                            </a>
                        </div>
                        <div class="links">
                            <a class="no-underline text-red-500" href="">
                                <img class="max-w-[30px]" src="{{asset('img/homepage/facebook.png')}}" alt="">
                            </a>
                            <a class="no-underline text-red-500" href="">
                                <img class="max-w-[30px]" src="{{asset('img/homepage/instagram.png')}}" alt="">
                            </a>
                            <a class="no-underline" href="">
                                <img class="max-w-[30px]" src="{{asset('img/homepage/LinkedIn.png')}}" alt="">
                            </a>
                            <a class="no-underline" href="">
                                <img class="max-w-[30px]" src="{{asset('img/homepage/twitter.png')}}" alt="">
                            </a>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <div class="col-span-full text-center bg-black py-3.5">
            <div class="wrapper">
                <p class="mb-0 text-[#fff] opacity-[0.8] text-[15px] font-[500]">Copyright @php
                    echo date('Y')
                    @endphp ©Eduracle. All rights reserved.</p>
            </div>
        </div>
    </footer>


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