<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Transaksi') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ url('transaksiStore') }}">
                @csrf

                <!-- Peminjam -->
                <div class="mt-4">
                    <x-input-label for="idPeminjam" :value="__('Peminjam*')" />
                    
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" id="idPeminjam" name="idPeminjam">
                        <option value="-1">--Pilih dahulu--</option>
                        @foreach ($users as $user)
                        @if ( $user->id == old('idPeminjam') )
                        <option value="{{ $user-> id }}" selected>{{ $user->fullname }}</option>
                        @else
                        <option value="{{ $user-> id }}">{{ $user->fullname }}</option>
                        @endif
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('idPeminjam')" class="mt-2" />
                </div>

                <!-- Koleksi 1 -->
                <div class="mt-4">
                    <x-input-label for="koleksi1" :value="__('Koleksi 1*')" />

                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" id="koleksi1" name="koleksi1">
                        <option value="-1">--Pilih dahulu--</option>
                        @foreach ($collections as $collection)
                        @if ( $collection->id == old('koleksi1') )
                        <option value="{{ $collection-> id }}" selected>{{ $collection->nama_koleksi }}</option>
                        @else
                        <option value="{{ $collection-> id }}">{{ $collection->nama_koleksi }}</option>
                        @endif
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('koleksi1')" class="mt-2" />
                </div>

                <!-- Koleksi 2 -->
                <div class="mt-4">
                    <x-input-label for="koleksi2" :value="__('Koleksi 2')" />

                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" id="koleksi2" name="koleksi2">
                        <option value="-1">--Pilih dahulu--</option>
                        @foreach ($collections as $collection)
                        @if ( $collection->id == old('koleksi2') )
                        <option value="{{ $collection-> id }}" selected>{{ $collection->nama_koleksi }}</option>
                        @else
                        <option value="{{ $collection-> id }}">{{ $collection->nama_koleksi }}</option>
                        @endif
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('koleksi2')" class="mt-2" />
                </div>

                <!-- Koleksi 3 -->
                <div class="mt-4">
                    <x-input-label for="koleksi3" :value="__('Koleksi 3')" />

                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" id="koleksi3" name="koleksi3">
                        <option value="-1">--Pilih dahulu--</option>
                        @foreach ($collections as $collection)
                        @if ( $collection->id == old('koleksi3') )
                        <option value="{{ $collection-> id }}" selected>{{ $collection->nama_koleksi }}</option>
                        @else
                        <option value="{{ $collection-> id }}">{{ $collection->nama_koleksi }}</option>
                        @endif
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('koleksi3')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-end mt-4">

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