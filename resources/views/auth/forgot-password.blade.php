<x-app-layout>
    <x-authentication-card>
        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>

        @session('status')
            <div class="mb-4 px-3 py-2 rounded-md font-medium border border-solid border-green-400 bg-green-50 text-green-600">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block mb-3">
                <x-label for="email" class="mb-1" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <x-button variant="primary" class="w-full mb-2">
                {{ __('Email Password Reset Link') }}
            </x-button>
            <p class="mb-0">Remember Password? <a href="{{ route('login') }}" class="font-semibold text-primary-500 no-underline">Go back to login</a>.</p>
        </form>
    </x-authentication-card>
</x-app-layout>
