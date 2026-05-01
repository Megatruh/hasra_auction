<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="font-serif tracking-tight text-3xl text-gray-950">Buat Akun</h1>
        <p class="mt-2 text-sm text-gray-600">Daftar untuk mulai menawar dengan elegan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-800" />
            <x-text-input id="name" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-800" />
            <x-text-input id="email" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Handphone Aktif -->
        <div class="mt-4">
            <x-input-label for="no_hp" :value="__('Nomor Handphone Aktif')" class="text-gray-800" />
            <x-text-input id="no_hp" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600" type="text" name="no_hp" :value="old('no_hp')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800" />

            <x-text-input id="password" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-800" />

            <x-text-input id="password_confirmation" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-sm text-gray-700 hover:text-gray-950 underline underline-offset-4 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-600 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-page)] transition">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
