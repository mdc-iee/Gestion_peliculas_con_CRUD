<x-layouts.layout>
    <div class="min-h-screen bg-gradient-to-br flex items-center justify-center px-4 from-black via-gray-900 to-black">
        <div
            class="w-full max-w-md bg-gray-900/90 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/20 p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-yellow-400 tracking-wide">
                    {{__("¡Bienvenido al cine!")}}
                </h1>
                <p class="text-gray-400 mt-2 text-sm">
                    {{__("Crea tu cuenta y empieza la función")}}
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" class="text-gray-300"/>
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300"/>
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-300"/>
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')"
                                   class="text-gray-300"/>
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full bg-gray-800 border-gray-700 text-gray-100 focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-4">
                    <a
                        href="{{ route('login') }}"
                        class="text-sm text-gray-400 hover:text-yellow-400 transition"
                    >
                        🎟️ {{__("¿Ya tienes entrada?")}}
                    </a>

                    <x-primary-button
                        class="bg-yellow-500 hover:bg-yellow-400 text-black font-semibold px-6 py-2 rounded-lg shadow-lg">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
