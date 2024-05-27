<header x-data="{showMenu: false, toggleMenu() {this.showMenu = !this.showMenu}}"
        class="py-4 fixed top-0 left-0 w-full z-50 bg-white">
        <nav class="px-2 sm:px-5 2xl:px-40 flex justify-between items-center">
            <div class="logo">
                <a href="">
                    <img src="{{ asset('img/homepage/logo.png') }}" alt="Logo"
                        class="max-w-[110px] sm:max-w-[160px] md:max-w-[260px]">
                </a>
            </div>
            <div :class="{'!left-0' : showMenu}"
                class="fixed lg:static top-[65px] -left-full h-96 lg:h-auto w-full lg:w-auto z-50 transition-all duration-500">
                <ul
                    class="list-none flex flex-col lg:flex-row justify-start lg:justify-center items-center gap-x-[30px] border border-blue-800 w-full h-full bg-white pt-8 lg:pt-0">
                    <li><a class="text-[18px] font-[400] text-center text-[#e72c25] block no-underline" href="">For
                            Institute</a></li>
                    <li><a class="text-[18px] font-[400] text-center text-[#9b9b9b] block no-underline" href="">For
                            Teacher</a></li>
                    <li><a class="text-[18px] font-[400] text-center text-[#9b9b9b] block no-underline" href="">For
                            Student</a></li>
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