@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection
