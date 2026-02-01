<x-layouts.layout>
    @guest
        <div class="hero min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white">
            <div class="hero-content text-center px-4">
                <div class="max-w-md bg-gray-900/80 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/30 p-10">
                    <h1 class="text-5xl md:text-6xl font-extrabold text-yellow-400 mb-4 tracking-wide">
                        {{ __("Por favor, regístrese") }}
                    </h1>
                </div>
            </div>
        </div>
    @endguest
    @auth
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img
                src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                class="max-w-sm rounded-lg shadow-2xl"
            />
            <div>
                <h1 class="text-5xl font-bold">{{__("¡Tenemos grandes noticias!")}}</h1>
                <p class="py-6">
                    {{__("Muy pronto llegan nuevas películas a nuestra cartelera, con estrenos llenos de acción, emoción, risas y aventuras para todos los gustos.")}}
                </p>
                <a href="{{route("films.index")}}"><button class="btn btn-primary">{{__("Ver películas")}}</button></a>
            </div>
        </div>
    </div>
    @endauth
</x-layouts.layout>
