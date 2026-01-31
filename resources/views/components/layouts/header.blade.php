
<div class="navbar shadow-sm bg-[#E59F71]">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
            </div>
            <ul
                tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a>Item 1</a></li>
                <li><a>Item 2</a></li>
                <li><a>Item 3</a></li>
                <li><a>Item 4</a></li>
            </ul>
        </div>
        <img class="h-40" src="{{asset("img/logo.png")}}" alt="Logo de la página">
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a>{{__("Inicio")}}</a></li>
            <li><a>{{__("Próximos estrenos")}}</a>
            <li><a>{{__("Cartelera actual")}}</a>
            <li><a>{{__("Sobre nosotros")}}</a></li>
        </ul>
    </div>
    <header class="flex justify-end p-4">
        <x-language-switcher />
    </header>
    <div class="navbar-end">
        <a class="btn btn-primary bg-red-400">{{__("Finalizar sesión")}}</a>
    </div>
</div>
