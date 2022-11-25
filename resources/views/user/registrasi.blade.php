<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Registrasi User') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ route('userStore') }}">
                @csrf

                <!-- Username -->
                <div class="mt-4">
                    <x-input-label for="username" :value="__('Username')" />

                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />

                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Fullname -->
                <div class="mt-4">
                    <x-input-label for="fullname" :value="__('Fullname')" />

                    <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required autofocus />

                    <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />

                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />

                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />

                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Birth Date -->
                <div class="mt-4">
                    <x-input-label for="birth_date" :value="__('Birth Date')" />

                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required autofocus />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div class="mt-4">
                    <x-input-label for="phone_number" :value="__('Phone Number')" />

                    <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus />

                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a> -->

                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>

                    <x-primary-button class="ml-4">
                        {{ __('Reset') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div> 
</x-app-layout>