<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h1 class="font-serif tracking-tight text-3xl text-gray-950">Masuk</h1>
        <p class="mt-2 text-sm text-gray-600">Ruang lelang yang tenang. Tawaran yang tegas.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-800" />
            <x-text-input id="email" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-800" />

            <x-text-input id="password" class="block mt-2 w-full border-gray-200 rounded-xl shadow-none focus:border-indigo-600 focus:ring-indigo-600"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm border-gray-300 text-indigo-600 shadow-none focus:ring-indigo-600" name="remember">
                <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-8">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-700 hover:text-gray-950 underline underline-offset-4 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-600 focus-visible:ring-offset-2 focus-visible:ring-offset-[var(--color-page)] transition">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
