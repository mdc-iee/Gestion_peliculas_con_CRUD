<div class="navbar shadow-sm bg-[#E59F71]">
    <div class="navbar-start">
        <img class="h-40" src="{{asset("img/logo.png")}}" alt="Logo de la página">
    </div>
    <div class="flex justify-end p-4">
        <x-language-switcher />
    </div>
    <!-- Si esto autenticado -->
    @auth
        <div class="navbar-end gap-4">
            <p>{{__("Hola")}} {{auth()->user()->name}}</p>
            <form action="/logout" method="post">
                @csrf {{-- Para evitar ataques cruzados (ciberseguridad) --}}
                <button type="submit" class="btn btn-primary bg-red-400 cursor-pointer">{{__("Finalizar sesión")}}</button>
            </form>
        </div>
    @endauth
    <!-- Si no estoy autenticado -->
    @guest
        <div class="navbar-end gap-4">
            <a href="{{route("login")}}"><button class="btn btn-sm btn-primary">{{__("Iniciar sesión")}}</button></a>
            <a href="{{route("register")}}"><button class="btn btn-sm btn-primary">{{__("Registrarse")}}</button></a>
        </div>
    @endguest
</div>
