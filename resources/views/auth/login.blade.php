<x-layouts.layout>
    <div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-black via-gray-900 to-black">
        <!-- Login card -->
        <div
            class="w-full max-w-md bg-gray-900/90 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/20 p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-yellow-400 tracking-wide">
                    {{__("¡Bienvenido de nuevo!")}}
                </h1>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-gray-300" :status="session('status')"/>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300"/>
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-300"/>
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-400">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded bg-gray-800 border-gray-700 text-yellow-500 focus:ring-yellow-500"
                            name="remember"
                        >
                        <span class="ms-2">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-gray-400 hover:text-yellow-400 transition"
                        >
                            ¿Olvidaste tu entrada?
                        </a>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end pt-4">
                    <x-primary-button
                        class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-lg shadow-lg">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.layout>
