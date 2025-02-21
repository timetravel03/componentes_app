# Manual de programador - Componentes App

Esta aplicación fue generada usando Laravel Crud Generator, a continuación comentaré los cambios más importantes que he realizado al comportamiento por defecto.

[Repositorio de github](https://github.com/timetravel03/componentes_app)

La aplicación se basa en una estructura de **tres tablas**:
- **Componentes** (Información sobre los componentes, con dos campos relacionales ligados a las otra dos tablas mediante ID’s)
- **Categorías** (Tipos de componentes)
- **Estados** (Posibles estados del componente)

## Migraciones
Modifiqué las funciones *up()* para darles la estructura necesaria
#### Tabla Categorias
```php
public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string("categoria");
            $table->timestamps();
        });
    }
```
#### Tabla Estados
```php
    public function up(): void
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string("estado");
            $table->timestamps();
        });
    }
```
#### Tabla Componentes
```php
    public function up(): void
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('modelo');
            $table->bigInteger('categoria_producto')->unsigned();
            $table->bigInteger('estado_producto')->unsigned();
            $table->foreign('categoria_producto')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('estado_producto')->references('id')->on('estados')->onDelete('cascade');
            $table->timestamps();
        });
    }
```

## Controladores

#### ***ComponenteController.php***
Las modificaciones principales realizadas a este controlador son la inclusión de querys de las tablas Categorías y Estados (ya que al estar estas relacionadas con ID’s en la tabla de Componentes no se hacen muy legibles), para obtener el nombre que corresponde a cada una en cada caso.

```php
    public function index(Request $request): View
    {
        $componentes = Componente::paginate();
        // Query a ambas tablas para hacer corresponder los ID's
        // con los nombres en la vista de índice
        $categorias = Categoria::all();
        $estados = Estado::all();


        return view('componente.index', compact('componentes', 'categorias', 'estados'))
            ->with('i', ($request->input('page', 1) - 1) * $componentes->perPage());
    }
```

```php
    public function create(): View
    {
        $componente = new Componente();
        // Aquí las querys se realizan con otro propósito, para incluir todas
        // las posibles opciones en un select en el fomulario de creación
        $categorias = Categoria::all();
        $estados = Estado::all();


        return view('componente.create', compact('componente', 'categorias', 'estados'));
    }
```

```php
    public function show($id): View
    {
        $componente = Componente::find($id);
        // Aquí se hacen tambien para identificar los estados y componentes,
        // pero como ya tenemos el id pues usamos find() para identificar solo los necesarios
        $estado = Estado::find($componente->estado_producto);
        $categoria = Categoria::find($componente->categoria_producto);


        return view('componente.show', compact('componente', 'estado', 'categoria'));
    }
```

```php
    public function edit($id): View
    {
        $componente = Componente::find($id);
        // Misma razón que para el create(), para los selects del formulario
        $categorias = Categoria::all();
        $estados = Estado::all();


        return view('componente.edit', compact('componente', 'categorias', 'estados'));
    }
```

## Vistas
Las principales modificaciones fueron el uso del dark theme de bootstrap (principalmente en las card-header de todas las vistas) e incluir un archivo de css propio (custom_app.css) y una tag de style en *app.blade.php* que permite darle un estilo consistente a todas las vistas. También incluí un enlace de acceso al *home*

#### ***app.blade.php***
```html
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/custom_app.css'])


    <style>
        body {
            background-image: url('{{ asset("images/circuit.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }
    </style>
```

```html
                    <ul class="navbar-nav">
                        @if(Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}">Inicio</a>
                            </li>
                        @endif
                    </ul>
```

#### ***welcome.blade.php***
Copié el aspecto de *home.blade.php*, pero solo incluí el logo de la compañía y un título
```html
@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            <img src="{{ asset("images/stock.png") }}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm text-center">
            <img src="{{ asset("images/logo_goblin_background.png") }}" class="img-fluid">
        </div>
    </div>
</div>
@endsection

```

#### ***home.blade.php***
Hice que todo el layout requiriera Auth::check() ya que la forma de acceder las funcionalidades están detrás de enlaces en cartas de bootstrap.
```html
    <div class="container">
    @if(Auth::check())
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('componentes.index')}}" class="text-decoration-none">
                <div class="card bg-dark text-white hover-zoom">
                    <div class="card-header bg-white text-dark">Listado de Componentes</div>


                    <div class="card-body">
                        Accede al listado de componentes en Stock
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-4">
            <a href="{{route('categorias.index')}}" class="text-decoration-none">
                <div class="card bg-dark text-white hover-zoom">
                    <div class="card-header bg-white text-dark">Categorias</div>


                    <div class="card-body">
                        Edita, añade o elimina las posibles categorias de los Componentes
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('estados.index')}}" class="text-decoration-none">
                <div class="card bg-dark text-white hover-zoom">
                    <div class="card-header bg-white text-dark">Estados</div>


                    <div class="card-body">
                        Edita, añade o elimina los posibles estados de los Componentes
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endif
</div>
```

#### ***componente/form.blade.php***
Realicé unas modificaciones en el controlador y en el layout que permite usar selects para elegir una categoría o estado de todos los posibles en la base de datos. Usando foreach para rellenarlos.
```html
<div class="row padding-1 p-1">
    <div class="col-md-12">


        <div class="form-group mb-2 mb20">
            <label for="modelo" class="form-label">{{ __('Modelo') }}</label>
            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo', $componente?->modelo) }}" id="modelo" placeholder="Modelo">
            {!! $errors->first('modelo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


        <div class="form-group mb-2 mb20">
            <label for="categoria_producto" class="form-label">{{ __('Categoría') }}</label>
            <select name="categoria_producto" class="form-control @error('categoria_producto') is-invalid @enderror" id="categoria_producto">
                <!-- Usando los foreach para rellenar los selects con los datos de las querys del controlador-->
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_producto', $componente?->categoria_producto) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->categoria }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('categoria_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


        <div class="form-group mb-2 mb20">
            <label for="estado_producto" class="form-label">{{ __('Estado') }}</label>
            <select name="estado_producto" class="form-control @error('estado_producto') is-invalid @enderror" id="estado_producto">
                <!-- Usando los foreach para rellenar los selects con los datos de las querys del controlador-->
                @foreach($estados as $estado)
                <option value="{{ $estado->id }}" {{ old('estado_producto', $componente?->estado_producto) == $estado->id ? 'selected' : '' }}>
                    {{ $estado->estado }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('estado_producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>


    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
```

#### ***componente/index.blade.php***
Aquí use las querys de la funcion index() del controlador para cambiar los id's de la relacion entre tablas a los valores que representan, también añadí una condición que previene la creación de nuevos componentes si no hay estados o categorias disponibles.
```html
                        <!-- Alrededor del botón de crear nuevo -->
                        <div class="float-right">
                            {{-- No te deja añadir nuevo cFomponente si no hay categorias o estados --}}
                            @if($categorias->isNotEmpty() && $estados->isNotEmpty())
                                <a href="{{ route('componentes.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                            @else
                                <a href="{{ route('componentes.create') }}" class="btn btn-primary btn-sm float-right disabled" data-placement="left">
                            @endif
                                {{ __('Create New') }}
                            </a>
                        </div>
```

```html
                            <tbody>
                                @foreach ($componentes as $componente)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                   
                                    <td>{{ $componente->modelo }}</td>
                                    {{-- indentifica la categoria que le corresponde al id --}}
                                    <td>{{ $categorias->firstWhere('id', $componente->categoria_producto)->categoria }}</td>
                                    {{-- indentifica el estado que le corresponde al id --}}
                                    <td>{{ $estados->firstWhere('id', $componente->estado_producto)->estado }}</td>


                                    <td>
                                        <form action="{{ route('componentes.destroy', $componente->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('componentes.show', $componente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('componentes.edit', $componente->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('{{__('Are you sure?')}}') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
```

#### ***componente/show.blade.php***
Aquí al modificación principal fue usar la querys que hice en el controlador para sustituir los id's de las claves foráneas por sus nombres

```html
                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Modelo:</strong>
                        {{ $componente->modelo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Categoria Producto:</strong>
                        {{ $categoria->categoria }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado Producto:</strong>
                        {{ $estado->estado }}
                    </div>
                </div>
```

## Seeders
Cree seeders para todas las tres tablas principales y para la tabla de users.

#### ***CategoriasSeeder.php***
```php
class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            'categoria'=>'Monitores'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Teclados'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Tarjetas Gráficas'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Procesadores'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Fuentes de Alimentación'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Placas Base'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Refrigeración'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Torres'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Premontados'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'PCs Completos'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Memorias RAM'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Almacenamiento'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Unidades de disco'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Unidades de disquetes'
        ]);
        DB::table('categorias')->insert([
            'categoria'=>'Otros'
        ]);
    }
}
```

#### ***EstadosSeeder.php***
```php
class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            'estado'=>'Nuevo'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Como Nuevo'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Usado pero funcional'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita revisión general'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita reparación'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita piezas'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Para el reciclaje'
        ]);
    }
}
```
#### ***ComponentesSeeder.php***
```php
class ComponentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Categorias
        $gpu = DB::table('categorias')->where('categoria', 'Tarjetas Gráficas')->value('id');
        $premontado = DB::table('categorias')->where('categoria', 'Premontados')->value('id');
        $cpu = DB::table('categorias')->where('categoria', 'Procesadores')->value('id');
        $monitores = DB::table('categorias')->where('categoria', 'Monitores')->value('id');
        $refrigeracion = DB::table('categorias')->where('categoria', 'Refrigeración')->value('id');

        //Estados
        $usado = DB::table('estados')->where('estado', 'Usado pero funcional')->value('id');
        $como_nuevo = DB::table('estados')->where('estado', 'Como Nuevo')->value('id');
        $revision = DB::table('estados')->where('estado', 'Necesita revisión general')->value('id');
        $piezas = DB::table('estados')->where('estado', 'Necesita piezas')->value('id');

        DB::table('componentes')->insert([
            'modelo' => 'Nvidia GT 210',
            'categoria_producto' => $gpu,
            'estado_producto' => $usado
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'Sony Trinitron',
            'categoria_producto' => $monitores,
            'estado_producto' => $piezas
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'Cooler Master 212',
            'categoria_producto' => $refrigeracion,
            'estado_producto' => $como_nuevo
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'Intel Pentium 4',
            'categoria_producto' => $cpu,
            'estado_producto' => $usado
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'Cooler Master 212',
            'categoria_producto' => $refrigeracion,
            'estado_producto' => $como_nuevo
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'AMD FX 6300',
            'categoria_producto' => $cpu,
            'estado_producto' => $usado
        ]);

        DB::table('componentes')->insert([
            'modelo' => 'HP Compaq 8200 Elite SFF',
            'categoria_producto' => $premontado,
            'estado_producto' => $revision
        ]);
    }
}
```

#### ***UserTableSeeder.php***
```php
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'test_user',
            'email' => 'test@mail.com',
            'password' => Hash::make('test')
        ]);
    }
```

## Localización
Para las localizaciones al español he usado los paquetes:  
[Coderic/laravel-spanish](https://github.com/Coderic/laravel-spanish)  
[Laravel-lang/lang](https://github.com/Laravel-Lang/lang)  
Complementado por un archivo propio (***es.json***):
```json
    {
    "A fresh verification link has been sent to your email address.": "Se ha enviado un nuevo enlace de verificación a su correo electrónico.",
    "Are you sure?": "¿Estás seguro?",
    "Before proceeding, please check your email for a verification link.": "Antes de continuar, compruebe el enlace de verificación en su correo electrónico.",
    "Categoria created successfully": "Categoría creado con éxito",
    "Categoria deleted successfully": "Categoría eliminado con éxito",
    "Categoria updated successfully": "Categoría actualizado con éxito",
    "click here to request another": "haga clic aquí para solicitar otro",
    "Componente created successfully": "Componente creado con éxito",
    "Componente deleted successfully": "Componente eliminado con éxito",
    "Componente updated successfully": "Componente actualizado con éxito",
    "Confirm Password": "Confirmar contraseña",
    "Create": "Crear",
    "Create New": "Crear Nuevo",
    "Dashboard": "Panel",
    "Delete": "Eliminar",
    "Edit": "Editar",
    "Email Address": "Correo electrónico",
    "Estado created successfully": "Estado creado con éxito",
    "Estado deleted successfully": "Estado eliminado con éxito",
    "Estado updated successfully": "Estado actualizado con éxito",
    "Forgot Your Password?": "¿Olvidó su Contraseña?",
    "If you did not receive the email": "Si usted no recibió el correo electrónico",
    "Login": "Iniciar sesión",
    "Logout": "Finalizar sesión",
    "Name": "Nombre",
    "Password": "Contraseña",
    "Please confirm your password before continuing.": "Por favor confirme su contraseña antes de continuar.",
    "Register": "Registrarse",
    "Remember Me": "Mantener sesión activa",
    "Reset Password": "Restablecer contraseña",
    "Send Password Reset Link": "Enviar enlace para restablecer la contraseña",
    "Show": "Mostrar",
    "Submit": "Enviar",
    "Toggle navigation": "Alternar navegación",
    "Update": "Actualizar",
    "Verify Your Email Address": "Verifique su dirección de correo electrónico",
    "You are logged in!": "¡Usted está conectado!",
    "Back": "Atrás"
}
```

## Posibles ampliaciones
- Cada usuario, al ser un tabajador de la empresa podría tener su propia lista de componentes que le han sido asignados
- Actualmente para uso en red local, pero podría hacerse accesible en internet con una gestión de usuarios más estricta, asi se podria usar fuera de la red local