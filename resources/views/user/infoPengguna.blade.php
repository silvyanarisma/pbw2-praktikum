<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Info Pengguna') }}
                </h2>
            </x-slot>

            <form method="POST" action="{{ url('userUpdate') }}">
                @csrf
                <div class="mt-4">
                    <label for="id" class="form-label">ID User</label>
                    <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="$user->id" readonly/>
                </div>

                <div class="mt-4">
                    <label for="fullname" class="form-label">Fullname</label>
                    <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="$user->fullname"/>
                </div>

                <div class="mt-4">
                    <label for="email" class="form-label">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email" readonly/>
                </div>

                <div class="mt-4">
                    <label for="password" class="form-label">Password</label>
                    <x-text-input id="password" class="block mt-1 w-full" type="text" name="password" :value="''"/>
                </div>

                <div class="mt-4">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$user->username}}" readonly>
                </div>

                <div class="mt-4">
                    <label for="address" class="form-label">Address</label>
                    <input id="address" name="address" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$user->address}}">
                </div>

                <div class="mt-4">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input id="phone_number" name="phone_number" type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" autocomplete="off" value="{{$user->phone_number}}" >
                </div>

                <div class="mt-4">
                    <label for="birth_date" class="form-label">Birth Date</label>
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="text" name="birth_date" :value="$user->birth_date" readonly/>
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