<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>
    <x-slot name="form">
        <div class="flex flex-wrap -mx-2">
            <div class="w-full sm:w-6/12 px-2 mb-3">
                <x-label for="current_password" value="{{ __('Current Password') }}" />
                <x-input id="current_password" type="password" class="mb-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" />
            </div>
            <div class="w-full sm:w-6/12 px-2 mb-3">
                <x-label for="password" value="{{ __('New Password') }}" />
                <x-input id="password" type="password" class="mb-1 block w-full" wire:model="state.password" autocomplete="new-password" />
                <x-input-error for="password" />
            </div>
            <div class="w-full sm:w-6/12 px-2 mb-3 sm:mb-0">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" class="mb-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" />
            </div>
            <div class="w-full sm:w-6/12 px-2 self-center mt-1">
                <x-button>
                    {{ __('Save') }}
                </x-button>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </div>
    </x-slot>
    <x-slot name="actions">
    </x-slot>
</x-form-section>
