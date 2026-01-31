<nav class="h-nav bg-nav flex items-center p-5 gap-3">
    <a href="{{route('main')}}"
       class="px-4 py-2 rounded-full text-sm font-medium bg-amber-900/40 text-amber-200
              hover:bg-amber-800/60 hover:text-amber-100 hover:scale-105 transition-all duration-200">
       {{__("Inicio")}}
    </a>
    <a href="{{route('estrenos')}}"
       class="px-4 py-2 rounded-full text-sm font-medium bg-amber-900/40 text-amber-200
              hover:bg-amber-800/60 hover:text-amber-100 hover:scale-105 transition-all duration-200">
       {{__("Próximos estrenos")}}
    </a>
    <a href="{{route('cartelera')}}"
       class="px-4 py-2 rounded-full text-sm font-medium bg-amber-900/40 text-amber-200
              hover:bg-amber-800/60 hover:text-amber-100 hover:scale-105 transition-all duration-200">
       {{__("Cartelera actual")}}
    </a>
    <a href="{{route('about')}}"
       class="px-4 py-2 rounded-full text-sm font-medium bg-amber-900/40 text-amber-200
              hover:bg-amber-800/60 hover:text-amber-100 hover:scale-105 transition-all duration-200">
       {{__("Sobre nosotros")}}
    </a>
</nav>
