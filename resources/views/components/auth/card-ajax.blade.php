<input type="radio" id="auth-card-tab-login" name="auth-card-tab" class="hidden" {{ request()->routeIs('register') ? '' : 'checked' }} />
<input type="radio" id="auth-card-tab-register" name="auth-card-tab" class="hidden" {{ request()->routeIs('register') ? 'checked' : '' }} />
<div class="auth-card-tabs select-none border-b border-0 border-solid border-b-primary-200">
    <div class="auth-card-tab-buttons relative flex w-full">
        <label for="auth-card-tab-login" class="w-6/12 px-3 py-2 font-semibold inline-flex items-center justify-center cursor-pointer rounded-t-md hover:bg-gray-100">
            Login
        </label>
        <label for="auth-card-tab-register" class="w-6/12 px-3 py-2 font-semibold inline-flex items-center justify-center cursor-pointer rounded-t-md hover:bg-gray-100">
            Register
        </label>
        <span class="auth-card-tabs-underline px-3 flex justify-center">
            <span class="relative bottom-0 w-full inline-block rounded-t-md bg-primary-500" style="height:4px;"></span>
        </span>
    </div>
</div>
<div class="auth-card-body px-3 py-3 overflow-y-auto">
    <div id="auth-card-content-login">
        <x-button.google />
        <div class="text-sm flex items-center text-center mt-2 mb-4 select-none">
            <span class="grow border-solid border-0 border-b border-gray-300"></span>
            <span class="px-2">{{ __('or continue with email') }}</span>
            <span class="grow border-solid border-0 border-b border-gray-300"></span>
        </div>
        @session('status')
            <div class="mb-4 px-3 py-2 rounded-md font-medium border border-solid border-green-400 bg-green-50 text-green-600">
                {{ $value }}
            </div>
        @endsession
        <form id="auth-card-login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <x-float.input id="auth-popup-login-email" name="email" type="text" value="" required label="Phone, username or email" placeholder="Email" class="mb-5" />
            <x-float.input id="auth-popup-login-password" name="password" type="password" value="" required label="Password" placeholder="Password" class="mb-4" />
            <div class="flex items-center justify-between mb-2">
                <label for="auth-popup-login-remember-me" class="flex gap-2 items-center">
                    <x-checkbox id="auth-popup-login-remember-me" name="remember" />
                    <span class="select-none cursor-pointer text-sm text-gray-800">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold focus:outline-primary-500 focus:outline-offset-2 no-underline text-primary-500" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                @endif
            </div>
            <div data-js="submit-status" class="px-3 py-1 mb-2 leading-snug text-sm font-medium rounded border border-solid hidden"></div>
            <x-button type="submit" variant="primary" size="lg" data-js="submit-btn" class="w-full mb-2">{{ __('Log in') }}</x-button>
        </form>
        <div class="">
            <p class="mb-0">I have no account. <label for="auth-card-tab-register" class="font-semibold text-primary-500 cursor-pointer">Create an account</label></p>
        </div>
    </div>
    <div id="auth-card-content-register">
        <x-button.google />
        <div class="text-sm flex items-center text-center mt-2 mb-4 select-none">
            <span class="grow border-solid border-0 border-b border-gray-300"></span>
            <span class="px-2">{{ __('or continue with email') }}</span>
            <span class="grow border-solid border-0 border-b border-gray-300"></span>
        </div>
        <form id="auth-card-register-form" method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            <x-float.input id="auth-popup-register-email" name="email" type="email" value="" required label="Email" placeholder="Email" class="mt-3 mb-5" />
            <x-float.input id="auth-popup-register-username" name="username" type="text" value="" required label="Username" placeholder="Username" class="mb-5" />
            <x-float.input id="auth-popup-register-name" name="name" type="text" value="" required label="Name" placeholder="Name" class="mb-5" />
            <x-float.input id="auth-popup-register-phone" name="phone" type="number" value="" required label="Phone" placeholder="Phone" class="mb-5" />
            <x-float.input id="auth-popup-register-password" name="password" type="password" value="" required label="Password" placeholder="Password" class="mb-3" />

            @if(false)
            <div class="mb-3 flex flex-wrap items-center gap-3 select-none">
                <div class="font-semibold">
                    I am a
                </div>
                <div class="relative">
                    <input type="radio" id="auth-card-user-role-student" value="{{ \App\Enums\UserRoleEnum::STUDENT }}" class="peer hidden" name="role">
                    <label for="auth-card-user-role-student" class="group cursor-pointer inline-flex px-3 py-1 font-medium leading-tight rounded-md border border-solid border-primary-500 peer-checked:bg-blue-500 peer-checked:text-white">
                        <span>Student</span>
                    </label>
                </div>
                <div class="relative">
                    <input type="radio" id="auth-card-user-role-teacher" value="{{ \App\Enums\UserRoleEnum::TEACHER }}" class="peer hidden" name="role">
                    <label for="auth-card-user-role-teacher" class="group cursor-pointer inline-flex px-3 py-1 font-medium leading-tight rounded-md border border-solid border-primary-500 peer-checked:bg-blue-500 peer-checked:text-white">
                        <span>Teacher</span>
                    </label>
                </div>
            </div>
            @endif

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="auth-popup-register-terms" name="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
            <div data-js="submit-status" class="px-3 py-1 mb-2 leading-snug text-sm font-medium rounded border border-solid hidden"></div>
            <x-button type="submit" data-js="submit-btn" class="w-full mb-2">{{ __('Register') }}</x-button>
        </form>
        <div class="">
            <p class="mb-0">Already have an account. <label for="auth-card-tab-login" class="font-semibold text-primary-500 cursor-pointer">Log In</label></p>
        </div>
    </div>
</div>