<x-app-layout>

    <section class="hero-section relative mt-[7rem] md:mt-[10rem]">
        <div class="wrapper px-2 sm:px-5 md:px-20 2xl:px-40 ">
            <div class="hero-banner grid lg:grid-cols-[60%_auto] grid-cols-1 justify-start">
                <div class="hero-text z-20 relative text-center lg:text-start">
                    <h2 class="z-20 relative text-[22px] md:text-[35px]">High Quality, Error-free</h2>
                    <h3 class="z-20 relative text-[27px] md:text-[43px] font-[700]">Digital and Printed Content</h3>
                    <h4
                        class="jee-neet z-20 relative text-transparent text-[20px] md:text-[27px] mb-[2.7rem] font-[600]">
                        <span class="for text-[#232323]">For</span>
                        <span class="jee-neet-text text-[#e82920]">JEE / NEET</span>
                        <span class="and-sign text-[#232323]">&</span>
                        <span class="foundation text-[#0538bc]">Foundation</span>
                    </h4>

                    <div class="desc z-20 relative">
                        <p class="text-[#4d4d4d] font-[400] text-[16px] md:text-[20px]">Looking for inventive content
                            that is better than those provided by the deep pocketed,
                            “national-chain” institutes?</p>
                    </div>

                    <div class="sub-desc z-20 relative">
                        <p class="font-[400] text-[#232323] text-[14px]">Your search ends here. We provide end-to-end
                            solutions for all academic content related needs
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


    <section class="our-perfection mt-10 w-full h-full overflow-hidden relative">
        <div class="swiper-container w-full h-full">
            <div class="swiper-wrapper">
                @for ($i = 1; $i <= 3; $i++)

                <div class="swiper-slide bg-[#eafee8] py-10 md:py-20">
                    <div class="px-2 sm:px-5 md:px-20 2xl:px-40 grid lg:grid-cols-[70%_auto] grid-cols-1 justify-between">
                        <div class="content-text">
                            <h2
                                class="heading md:text-[42px] md:leading-[60px] text-7 leading-8 font-[700] text-[#232323] mb-4 text-center lg:text-start">
                                Digital Platform with Perfect Synergy of <span
                                    class="sub-text text-[#e82920] font-[700]"> Online
                                    & Offline Tests</span>
                            </h2>
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
                            <div class="buttons text-center lg:text-start">
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
            <!-- If you need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
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
                    <h3
                        class="sub-heading text-[#6b6b6b] text-[1rem] leading-[28px] font-[400] w-full md:max-w-[50%] mx-auto">
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

    <footer class="bg-no-repeat bg-cover" style="background-image: url('{{ asset('img/homepage/footerbg.png') }}');">
        <div class="footer-wrapper px-2 sm:px-5 2xl:px-40 py-[2rem]">
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


    @vite('resources/js/app.js')

    {{-- alpine js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> --}}

    <script>
        let video = document.getElementById("myVideo");
    video.muted = true;
    video.autoplay = true;
    video.addEventListener('canplay', function() {
        video.play();
    });

    </script>
</x-app-layout>