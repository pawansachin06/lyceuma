@extends('layouts.layout')
@section('contents')

<div class="pt-[5rem] md:pt-[7rem] bg-[#e8eefe]">
    <div class="grid grid-cols-1 md:grid-cols-[50%__auto] px-2 sm:px-5 2xl:px-40">
        <div class="py-12">
            <h2 class="font-bold text-6 sm:text-8 md:text-[40px] mb-10">Get in touch with Us!</h2>
            <form action="" method="POST">
                @csrf
                @method('POST')
                <div class="form-fields flex flex-col gap-y-5 md:gap-y-8">
                    <div class="">
                        <input
                            class="w-full bg-transparent focus:border-none focus:outline-none focus:ring-0 focus:shadow-[box-shadow:none] placeholder:text-[#3e3e3e]"
                            type="text" id="name" name="name" placeholder="Full Name">
                    </div>
                    <div class="">
                        <input
                            class="w-full bg-transparent focus:border-none focus:outline-none focus:ring-0 focus:shadow-[box-shadow:none] placeholder:text-[#3e3e3e]"
                            type="email" id="email" name="email" placeholder="Enter Your Email Id">
                    </div>
                    <div class="">
                        <input
                            class="w-full bg-transparent focus:border-none focus:outline-none focus:ring-0 focus:shadow-[box-shadow:none] placeholder:text-[#3e3e3e]"
                            type="tel" id="mobile" name="mobile" placeholder="Mobile Number">
                    </div>
                    <div class="w-full">
                        <textarea
                            class="w-full bg-transparent border-1 border-solid border-[rgba(62,62,62,.18)] focus:border-1 focus:border-solid focus:border-[rgba(62,62,62,.18)] focus:outline-none focus:ring-0 focus:shadow-[box-shadow:none] placeholder:text-[#3e3e3e]"
                            id="message" name="message" placeholder="Message">
                    </textarea>
                    </div>

                    <div>
                        <a
                            class="btn-red bg-[#e72c25] text-white font-[600] text-[12px] sm:text-[18px] p-[8px_30px] md:p-[8px_75px] border-0.5 border-solid border-[#e72c25] rounded-1 transition-all duration-300 no-underline inline-block hover:bg-[#212529] hover:border-[#212529]">Submit</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="">
            <img src="{{ asset('img/contactus/contact.png') }}" alt=""
                class="max-w-full w-full max-h-[600px] object-contain">
        </div>
    </div>
</div>

<div class="locations py-8 md:py-14">
    <div class="px-2 sm:px-5 2xl:px-40">
        <h2 class="text-center text-3xl sm:4xl md:text-5xl mb-8 font-bold">Locations</h2>
    </div>
    <div class="grid grid-cols-1 w-full md:max-w-5xl mx-auto md:grid-cols-2 gap-5 justify-center">
        @for ($i = 1; $i <= 2; $i++) <div class="bg-[rgba(255,232,199,.47)]">
            <div class="address p-6 w-full">
                <h4 class="font-bold text-2xl md:text-3xl mb-6">Pune Office</h4>
                <div class="w-full">
                    <div class=" flex flex-row gap-x-[20px] justify-start">
                        <div>
                            <img src="{{asset('img/homepage/location.svg')}}" alt="">
                        </div>
                        <p class="text-[13px]">

                            721, 7th Floor, East Wing West Side,
                            Marisoft-3, Marigold Premises, Kalyani Nagar,
                            Pune (MH) 411014
                        </p>
                    </div>
                </div>
            </div>
    </div>

    @endfor

</div>
</div>
@endsection