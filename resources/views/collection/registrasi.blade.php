<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Registrasi Koleksi') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ route('koleksiStore') }}">
                @csrf

                <!-- Nama -->
                <div class="mt-4">
                    <x-input-label for="nama" :value="__('Nama')" />

                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />

                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Jumlah -->
                <div class="mt-4">
                    <x-input-label for="jumlah" :value="__('Jumlah')" />

                    <x-text-input id="jumlah" class="block mt-1 w-full" type="text" name="jumlah" :value="old('jumlah')" required autofocus />

                    <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                </div>

                <!-- Jenis -->
                <div class="mt-4">
                    <x-input-label for="jenis" :value="__('Jenis')" />

                    <x-text-input id="jenis" class="block mt-1 w-full" type="number" name="jenis" :value="old('jenis')" required autofocus />

                    <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
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