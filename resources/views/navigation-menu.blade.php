<nav class="sticky top-0 h-14 px-2 flex justify-between bg-white shadow-sm border-gray-100 z-10">
    <a href="{{ route('dashboard') }}" class="flex-none flex flex-row items-center text-xl truncate select-none no-underline text-gray-800 focus:outline focus:outline-primary-500">
        <div class="flex flex-col h-full leading-snug mb-1 justify-center truncate">
            <div class="truncate font-semibold">{{ config('app.name') }}</div>
            <small class="block text-sm leading-none font-medium truncate">{{ auth()->user()->role }} PANEL</small>
        </div>
    </a>
    <div class="inline-flex items-center gap-2">
        <div class="inline-flex flex-col leading-tight text-right">
        </div>
        <label for="app-sidebar-checkbox" title="Toggle sidebar" class="app-sidebar-btn lg:hidden group inline-flex items-center justify-center cursor-pointer text-gray-600 hover:text-gray-900 transition-colors">
            <span class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-gray-300 bg-gray-100 group-hover:bg-gray-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" width="24" height="24" viewBox="0 -960 960 960"><path d="M160-240q-17 0-28.5-11.5T120-280q0-17 11.5-28.5T160-320h640q17 0 28.5 11.5T840-280q0 17-11.5 28.5T800-240H160Zm0-200q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm0-200q-17 0-28.5-11.5T120-680q0-17 11.5-28.5T160-720h640q17 0 28.5 11.5T840-680q0 17-11.5 28.5T800-640H160Z"/></svg>
            </span>
        </label>
    </div>
</nav>