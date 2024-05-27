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
@stack('scripts')

</script>
</body>

</html>