<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="relative flex gap-3 mb-3">
                <div class="w-auto flex-none flex flex-row-reverse">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden"
                                wire:model.live="photo"
                                x-ref="photo"
                                x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />
                    <!-- Current Profile Photo -->
                    <label for="photo" class="rounded-lg border border-solid border-gray-300 h-20 w-20" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-lg h-full w-full object-cover">
                    </label>

                    <!-- New Profile Photo Preview -->
                    <label for="photo" class="rounded-lg border border-solid border-gray-300 h-20 w-20" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-lg w-full h-full bg-cover bg-no-repeat bg-center"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </label>
                </div>
                <div class="flex-none flex flex-col gap-1 justify-center items-start">
                    <button class="px-1 py-1 rounded-md border-primary-500 bg-primary-500 hover:bg-primary-600 text-white" title="{{ __('Select A New Photo') }}" type="button" x-on:click.prevent="$refs.photo.click()">
                        <x-icons.add-photo class="w-6 h-6" />
                    </button>
                    @if ($this->user->profile_photo_path)
                        <button class="px-1 py-1 rounded-md border-red-500 bg-red-500 hover:bg-red-600 text-white" type="button" title="{{ __('Remove Photo') }}" class="" wire:click="deleteProfilePhoto">
                            <x-icons.delete class="w-6 h-6" />
                        </button>
                    @endif
                </div>
            </div>
            <x-input-error for="photo" class="mt-2" />
        @endif
            <div class="flex flex-wrap -mx-2">
                <!-- Name -->
                <div class="w-full sm:w-6/12 px-2 mb-3">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <!-- Email -->
                <div class="w-full sm:w-6/12 px-2 mb-3">
                    <x-label for="email" value="{{ __('Email') }}" class="mb-1" />
                    <x-input id="email" type="email" class="mb-1 block w-full" wire:model="state.email" required autocomplete="username" />
                    <x-input-error for="email" class="mb-2" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                        <p class="text-sm mb-2">
                            {{ __('Your email address is unverified.') }}

                            <button type="button" class="border-0 px-0 bg-transparent text-sm font-medium text-primary-500" wire:click.prevent="sendEmailVerification">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if ($this->verificationLinkSent)
                            <p class="mb-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    @endif
                </div>
            </div>
    </x-slot>
    <x-slot name="actions">
        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
        <x-action-message class="ms-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>
    </x-slot>
</x-form-section>
