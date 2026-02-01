<x-layouts.layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black px-4">
        <form method="POST" action="{{ route('films.store') }}"
              class="w-full max-w-xl bg-gray-900/80 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/20 p-8 text-white">
            @csrf
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-yellow-400 tracking-wide">
                    {{__("Nueva película")}}
                </h1>
            </div>

            <!-- Título -->
            <div class="mb-5">
                <x-input-label class="text-gray-300 mb-1">
                    {{__("Título")}}
                </x-input-label>
                <x-text-input
                    class="w-full border border-white"
                    type="text"
                    name="name"
                    :value="old('name')"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <!-- Género -->
            <div class="mb-5">
                <x-input-label class="text-gray-300 mb-1">
                    {{__("Género")}}
                </x-input-label>
                <x-text-input
                    class="w-full border border-white"
                    type="text"
                    name="genre"
                    :value="old('genre')"
                />
                <x-input-error :messages="$errors->get('genre')" class="mt-2"/>
            </div>

            <!-- Duración -->
            <div class="mb-5">
                <x-input-label class="text-gray-300 mb-1">
                    {{__("Duración")}}
                </x-input-label>
                <x-text-input
                    class="w-full border border-white"
                    type="number"
                    name="duration"
                    :value="old('duration')"
                />
                <x-input-error :messages="$errors->get('duration')" class="mt-2"/>
            </div>

            <!-- Director -->
            <div class="mb-5">
                <x-input-label class="text-gray-300 mb-1">
                    {{__("Director")}}
                </x-input-label>
                <x-text-input
                    class="w-full border border-white"
                    type="text"
                    name="director"
                    :value="old('director')"
                />
                <x-input-error :messages="$errors->get('director')" class="mt-2"/>
            </div>

            <!-- Descripción -->
            <div class="mb-6">
                <x-input-label class="text-gray-300 mb-1">
                    {{__("Descripción")}}
                </x-input-label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded-md bg-gray-800 border-gray-700 text-white focus:ring-yellow-500 focus:border-yellow-500"
                >{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2"/>
            </div>
            <!-- Botones -->
            <div class="flex justify-between items-center">
                <a href="{{ route('films.index') }}"
                   class="btn btn-sm btn-outline text-gray-300 hover:text-white">
                    {{__("Cancelar")}}
                </a>
                <button type="submit" class="btn btn-success btn-sm shadow-md">
                    {{__("Crear")}}
                </button>
            </div>
        </form>
    </div>
</x-layouts.layout>
