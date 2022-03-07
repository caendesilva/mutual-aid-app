<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <fieldset>
                <legend class="mb-2 font-bold">
                    Required fields
                </legend>

                <div>
                    <x-jet-label for="name" value="{{ __('Name*') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email*') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password*') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </fieldset>

            <fieldset class="my-4">
                <legend class="mb-2 font-bold">
                    Optional fields
                </legend>

                <div>
                    <x-jet-label for="phone" value="{{ __('Phone Number') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="area" value="{{ __('Zip Code') }}" />
                    <x-jet-input id="area" class="block mt-1 w-full" type="text" name="area" :value="old('area')" />
                    <small>To show results near you</small>
                </div>
            </fieldset>

            <fieldset>
                <legend class="mt-2 font-bold">
                    Finalize
                </legend>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4 mb-2">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" required/>

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </fieldset>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
