<x-layouts.layout>
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
                <button class="btn btn-primary">{{__("Ver películas")}}</button>
            </div>
        </div>
    </div>
</x-layouts.layout>
