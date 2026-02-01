# PRÁCTICA LARAVEL
Este proyecto es una aplicación web para la gestión de películas,
desarrollada con Laravel como framework principal. Permite 
realizar todas las operaciones típicas de un CRUD (Crear, Leer, 
Actualizar y Eliminar) sobre películas y traducir la interfaz completamente, 
facilitando la administración de un catálogo de forma sencilla y 
organizada y habilitando la accesibilidad de esta a personas de 
diferentes países.

El objetivo principal es proporcionar una herramienta de gestión 
de películas multilingüe, donde cada película puede tener 
información disponiendo, además, de la edición y eliminación de estas y 
teniendo una interfaz amigable, interactiva y moderna gracias a 
las tecnologías de frontend utilizadas.
***
## Requisitos
Para poder ejecutar la aplicación en tu entorno local, se 
necesitarán tener instalados PHP, Composer, Node.js, Docker y Git.

* Para que corra el proyecto en dev simplemente escribiendo en la terminal:
```bash
npm run local
```
Gracias a que, en el package.json hay un script que hace que se
levanten los contenedores de docker asociados al proyecto, 
inicie el servidor de desarrollo del frontend y de Laravel.
```json
"local": "docker compose up -d && concurrently \"npm run dev\" \"php artisan serve \" "
```
***
## Instalación de las traducciones
### Instalar paquetes para la utilidad

```bash
composer require laravel-lang/lang
```
> Si eres de Linux, depende de paquetes como php-initl y php-bcmath

### Instalar idiomas
Ahora debemos de cargar los idiomas que queremos utilizar.
Esto creará el fichero lang.json y la carpeta correspondiente
```bash
php artisan lang:add es
```

### En el front
Creación de un componente desplegable para seleccionar el idioma

```html
<select class="bg-gray-300 p-3" name="lang" id="">
    <option value="" disabled selected>{{__("Selecciona idioma")}}</option>
    @foreach(config("languages") as $code => $content)
        <option>{{$content['name']}} {{$content['flag']}}</option>
    @endforeach
</select>
```

De forma que si queremos añadir nuevos idiomas solo tenga que agregar un nuevo elemento en el array

```php
<?php
return [
    "es" => [
        "name" => "Español",
        "flag" => "🇪🇸"
    ],
    "fr" => [
        "name" => "France",
        "flag" => "🇫🇷"
    ],
    "en" => [
        "name" => "English",
        "flag" => "🇬🇧"
    ],
    "ru" => [
        "name" => "Ruso",
        "flag" => "🇷🇺"
    ]
];
```

### En el back
#### Crear un controlador
Con el objetivo de que el usuario pueda cambiar el idioma, lo creo invokable por comodidad
```bash
php artisan make:controller SetLanguageController -i
```

* Escribimos el código en el controlador
```php
public function __invoke(string $lang)
    {
        // Establecemos la variable de sesión
        session()->put('lang', $lang);
        app()->setLocale($lang);
        // Devuelveme a la última página en la que estaba aunque no es necesario ya que laravel lo hace de por si
        return redirect()->back();
    }
```
### Middleware
Como queremos que cualquier solicitud antes de ser atendida se establezca como variable de
entorno lo que tenga en la variable de sesión (si la tengo), necesito un middleware
(software que se ejecuta entre el request y el response)
```bash
php artisan make:Middleware SetLanguageMiddleware
```

* El código
```php
public function handle(Request $request, Closure $next): Response
    {
        $lang = session()->get('lang') ?? config('app.locale');
        // app() es un helper para acceder a la aplicación
        app()->setLocale($lang);
        return $next($request);
    }
```

#### Asocio el middleware a todas las rutas que tenga en el fichero web.php
Esto se hace en el fichero de inicio de la aplicación
  ./bootstrap/app.php. Ahí añadimos en la sección de Middleware
```php
->withMiddleware(function (Middleware $middleware): void {
        // Estoy asociando este middleware para que se aplique a todas las rutas
        $middleware->web(append: [
            SetLanguageMiddleware::class,
        ]);
    })
```

Nos falta modificar el front con el evento que solicitará la ruta al back
```html
<select onchange="window.location.href=this.value" class="bg-gray-300 p-3" name="lang" id="">
    <option value="" disabled selected>{{__("Selecciona idioma")}}</option>
    @foreach(config("languages") as $code => $content)
    <option value="{{route("set_lang", $code)}}">{{$content['name']}} {{$content['flag']}}</option>
    @endforeach
</select>
```
***
### CRUD Y LA BASE DE DATOS
Los datos serán almacenados gracias a Docker, por lo tanto 
estará el archivo docker-compose.yaml con la configuración del 
contenedor de mysql y en el .env:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=23306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_username
DB_PASSWORD=tu_contraseña
DB_ROOT_PASSWORD=tu_contraseña_de_root
```

### Cómo crear un modelo

Ejecutamos el comando para crear el modelo Film junto a los demás ficheros que van a
ser necesarios para gestionar los métodos de la base de datos
```bash
php artisan make:model Film --all
```

Para poder ver todas las rutas que contiene el controlador de Film:

* Primero escribimos en web.php:
```bash
use App\Http\Controllers\FilmController;

Route::resource('films', FilmController::class)->middleware(['auth', 'verified']);
```
* Y entonces ya podemos escribir en la terminal:
```bash
php artisan route:list --name=films
```
Nos mostraría algo así:
```
  GET|HEAD        films ....................................................................................................................... films.index › FilmController@index
  POST            films ....................................................................................................................... films.store › FilmController@store
  GET|HEAD        films/create .............................................................................................................. films.create › FilmController@create
  GET|HEAD        films/{film} .................................................................................................................. films.show › FilmController@show
  PUT|PATCH       films/{film} .............................................................................................................. films.update › FilmController@update
  DELETE          films/{film} ............................................................................................................ films.destroy › FilmController@destroy
  GET|HEAD        films/{film}/edit ............................................................................................................. films.edit › FilmController@edi                                                                                                                                                      Showing [7] routes
```

### Migraciones
El archivo de migración que ha generado se encuentra en 
database/migrations, donde se pueden definir los campos de 
la tabla "films" en el método _up()_

```php
public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('genre');
            $table->integer('duration');
            $table->string('director');
            $table->string('description');
            $table->timestamps();
        });
    }
```
* Para aplicar la migración y crear la tabla en la base de datos
```bash
php artisan migrate
```
* Para recrear las tablas en caso de algún posible fallo y/o seedear la base de datos
```bash
php artisan migrate:fresh

php artisan migrate:fresh --seed
```
**Tener en cuenta que esto borra los datos de la tabla**

Una vez creado el modelo Film, se puede utilizar para interactuar 
con la base de datos
```php
class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $fillable = ['name', 'genre', 'duration', 'director', 'description'];
}
```
Almacenamos las películas en un script dentro de la carpeta config
```php
<?php
return [
    [
        "name" => "The Last Projection",
        "genre" => "Drama",
        "duration" => 128,
        "director" => "Michael Anderson",
        "description" => "Un viejo proyeccionista reflexiona sobre su vida mientras restaura un antiguo cine."
    ],
    [
        "name" => "Neon Nights",
        "genre" => "Thriller",
        "duration" => 110,
        "director" => "Sofia Martinez",
        "description" => "Un detective investiga una serie de crímenes en una ciudad que nunca duerme."
    ],
    [
        "name" => "Beyond the Stars",
        "genre" => "Science Fiction",
        "duration" => 142,
        "director" => "Ethan Collins",
        "description" => "Un astronauta emprende una misión que cambiará la humanidad para siempre."
    ],
    [
        "name" => "Silent Frames",
        "genre" => "Mystery",
        "duration" => 97,
        "director" => "Laura Bennett",
        "description" => "Una fotógrafa descubre un oscuro secreto oculto en antiguas fotografías."
    ],
    [
        "name" => "Midnight Encore",
        "genre" => "Horror",
        "duration" => 102,
        "director" => "James Holloway",
        "description" => "Un teatro maldito cobra vida tras la última función de la noche."
    ],
    [
        "name" => "Golden Reel",
        "genre" => "Drama",
        "duration" => 135,
        "director" => "Francesco Romano",
        "description" => "El ascenso y caída de un legendario director de cine."
    ],
    [
        "name" => "Laugh Track",
        "genre" => "Comedy",
        "duration" => 95,
        "director" => "Kevin Brooks",
        "description" => "Un cómico en apuros encuentra el éxito de la manera más inesperada."
    ],
    [
        "name" => "Shadows of the Past",
        "genre" => "Drama",
        "duration" => 121,
        "director" => "Ana López",
        "description" => "Una mujer confronta los recuerdos de su infancia al regresar a su ciudad natal."
    ],
    [
        "name" => "Fast Lane",
        "genre" => "Action",
        "duration" => 108,
        "director" => "Mark Reynolds",
        "description" => "Un corredor clandestino se ve obligado a participar en una última carrera peligrosa."
    ],
    [
        "name" => "Paper Dreams",
        "genre" => "Romance",
        "duration" => 104,
        "director" => "Claire Dupont",
        "description" => "Dos escritores se enamoran a través de cartas anónimas."
    ],
    [
        "name" => "The Final Cut",
        "genre" => "Thriller",
        "duration" => 119,
        "director" => "Oliver Stonewood",
        "description" => "Un editor descubre metraje que nunca debió ser visto."
    ],
    [
        "name" => "Echoes in the Dark",
        "genre" => "Horror",
        "duration" => 100,
        "director" => "Natalie King",
        "description" => "Extraños sonidos acechan a una familia que vive cerca de un estudio abandonado."
    ],
    [
        "name" => "Bright Tomorrow",
        "genre" => "Family",
        "duration" => 92,
        "director" => "Tomás Herrera",
        "description" => "Un niño descubre el poder de la imaginación a través del cine."
    ],
    [
        "name" => "Lost in Editing",
        "genre" => "Comedy",
        "duration" => 98,
        "director" => "Rachel Moore",
        "description" => "Un equipo de postproducción caótico lucha contra el tiempo para terminar una película."
    ],
    [
        "name" => "Cold Spotlight",
        "genre" => "Crime",
        "duration" => 126,
        "director" => "Victor Novak",
        "description" => "Un periodista expone la corrupción en la industria del entretenimiento."
    ],
    [
        "name" => "Frame by Frame",
        "genre" => "Documentary",
        "duration" => 88,
        "director" => "Isabel Chen",
        "description" => "Un profundo análisis sobre la evolución de las técnicas cinematográficas."
    ],
    [
        "name" => "Desert Screen",
        "genre" => "Adventure",
        "duration" => 140,
        "director" => "Samuel Wright",
        "description" => "Un cineasta recorre desiertos para documentar culturas que están desapareciendo."
    ],
    [
        "name" => "Broken Script",
        "genre" => "Drama",
        "duration" => 113,
        "director" => "Daniel Foster",
        "description" => "Un guionista lucha por terminar su historia más personal."
    ],
    [
        "name" => "Night Premiere",
        "genre" => "Mystery",
        "duration" => 105,
        "director" => "Helena Sørensen",
        "description" => "Un estreno cinematográfico se torna mortal cuando secretos salen a la luz."
    ],
    [
        "name" => "Silver Curtain",
        "genre" => "Drama",
        "duration" => 130,
        "director" => "Luis Mendoza",
        "description" => "Una actriz veterana lucha por mantenerse relevante en una industria en constante cambio."
    ],
];
?>
```

Los seeders serán utilizados para sembrar la base de datos con 
estos datos iniciales. Esto se ubican en database/seeders

**FilmSeeder**
```php
public function run(): void
    {
        // Esta función llama 20 veces a la fábrica y crea los proyectos en la tabla de la base de datos (si hay 50, solo creará 20)
        Film::factory()->count(20)->create();
    }
```

**DatabaseSeeder**
```php
// Cargará todos los seeders de la carpeta
$this::call([
    FilmSeeder::class,
]);
```

Y FilmController para que podamos mostrar, crear, editar y borrar 
datos de una tabla
```php
class FilmController extends Controller
{
    // Mostrar aunque también se puede utilizar show()
    public function index()
    {
        // con paginate(nº) devolverá el número de proyectos que escribamos dentro del paréntesis
        $films = Film::paginate(5);
        $fields = $films->first()->getFillable()??[];
        return view('films.lists', compact('films', 'fields'));
    }

    // Crear
    public function create()
    {
        return view('films.create');
    }

    // Almacenar
    public function store(StoreFilmRequest $request)
    {
        $values = $request->input();
        Film::create($values);
        return redirect()->route('films.index')->with('success', 'La película se ha creado exitosamente.');
    }

    // Editar
    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    // Actualizar
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $page = $request->input('page');
        $film->update($request->input());
        return redirect()->route('films.index')->with('success', 'La película se ha actualizado exitosamente.');
    }

    // Eliminar
    public function destroy(Film $film)
    {
        $film->delete();
        // Crea una variable de un solo uso
        return redirect()->route('films.index')->with('success', 'Película borrada.');
    }
}
```

> En StoreFilmRequest y UpdateFilmRequest modificamos la autorización 
> a _true_ para que el usuario pueda editar los datos de una película 
> correctamente si se ha registrado.

**StoreFilmRequest.php**
```php
public function authorize(): bool
    {
        return true;
    }

// Reglas a seguir para que la película se actualice
public function rules(): array
    {
        return [
            "name" => "required|string",
            "genre" => "required|string",
            "duration" => "required|numeric",
            "director" => "required|string",
            "description" => "required|string",
        ];
    }
```

**UpdateFilmRequest.php**
```php
public function authorize(): bool
    {
        return true;
    }
```

Y para finalizar, ya sería la creación de las vistas en 
resources/views/films, teniendo en cuenta que en los formularios 
y las tablas estén escritas las rutas correspondientes (Como la 
carpeta films no existía, la he creado). Ejemplo:

**lists.blade.php**
```html
<x-layouts.layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white p-8">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('films.create') }}">
                <button class="btn btn-primary shadow-lg">
                    {{__("Agregar película")}}
                </button>
            </a>
        </div>
        <!-- Tabla -->
        <div class="overflow-x-auto bg-gray-900/80 backdrop-blur-md rounded-2xl shadow-2xl border border-yellow-500/20 p-6">
            <table class="table w-full text-sm">
                <thead class="text-yellow-300">
                <tr>
                    @foreach($fields as $field)
                        <th class="uppercase tracking-wide">
                            {{ ucfirst($field) }}
                        </th>
                    @endforeach
                    <th class="text-center">Editar</th>
                    <th class="text-center">Borrar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($films as $film)
                    <tr class="hover:bg-gray-800 transition">
                        <td>{{ $film->name }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->duration }} min</td>
                        <td>{{ $film->director }}</td>
                        <td class="max-w-xs truncate" title="{{ $film->description }}">
                            {{ $film->description }}
                        </td>
                        <!-- Editar -->
                        <td class="text-center">
                            <a href="{{ route('films.edit', ['film' => $film->id, 'page' => request('page')]) }}">
                                <button class="btn btn-sm btn-outline btn-info">
                                    {{__("Editar")}}
                                </button>
                            </a>
                        </td>
                        <!-- Borrar -->
                        <td class="text-center">
                            <form action="{{ route('films.destroy', ['film' => $film->id, 'page' => request('page')]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmar(event)" type="submit" class="btn btn-sm btn-outline btn-error">
                                    {{__("Borrar")}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success mt-6 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="mt-6 flex justify-center">
            <div class="bg-blue-200 px-4 py-2 rounded-xl shadow-md">
                {{ $films->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmar(e) {
            e.preventDefault();
            const form = e.currentTarget.closest("form");

            Swal.fire({
                title: "Confirmar borrado",
                text: "¿Seguro que quieres borrar esta película?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e11d48",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-layouts.layout>
```
