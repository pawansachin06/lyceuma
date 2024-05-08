<x-app-layout>
    <x-authentication-card>
        <p>
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 px-3 py-2 rounded-md font-medium border border-solid border-green-400 bg-green-50 text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-button type="submit" class="w-full mb-3">
                {{ __('Resend Verification Email') }}
            </x-button>
        </form>

        <div class="flex justify-between">
            <a
                href="{{ route('profile.show') }}"
                class="no-underline font-semibold"
            >
                {{ __('Edit My Profile') }}</a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="font-semibold border-0 bg-transparent text-red-600">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-app-layout>
