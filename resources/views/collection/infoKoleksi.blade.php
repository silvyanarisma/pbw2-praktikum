<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Info Koleksi') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ url('koleksiUpdate') }}">
                @csrf
                <div class="mt-4">
                    <label for="id" class="form-label">ID Koleksi</label>
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="$collection->id" readonly/>
                </div>

                <div class="mt-4">
                    <label for="nama" class="form-label">Judul Koleksi</label>
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="$collection->nama_koleksi" readonly />
                </div>

                <div class="mt-4">
                <label for="jenis" class="form-label">Jenis</label>
                    <select id="jenis" name="jenis" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                        <option value="-1" @if(old('jenis', $collection->jenis) == -1) selected @endif>Pilih Satu</option>
                        <option value="1" @if(old('jenis', $collection->jenis) == 1) selected @endif>Buku</option>
                        <option value="2" @if(old('jenis', $collection->jenis) == 2) selected @endif>Majalah</option>
                        <option value="3" @if(old('jenis', $collection->jenis) == 3) selected @endif>Cakram Digital</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label for="jumlah_awal" class="form-label">Jumlah Awal</label>
                    <input id="jumlah_awal" name="jumlah_awal" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$collection->jumlah_awal}}" readonly>
                </div>

                <div class="mt-4">
                    <label for="jumlah_sisa" class="form-label">Jumlah Sisa</label>
                    <input id="jumlah_sisa" name="jumlah_sisa" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$collection->jumlah_sisa}}">
                </div>

                <div class="mt-4">
                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                    <input id="jumlah_keluar" name="jumlah_keluar" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$collection->jumlah_keluar}}" >
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>

                    <x-primary-button class="ml-4" type="reset">
                        {{ __('Reset') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>