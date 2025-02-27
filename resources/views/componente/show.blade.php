@extends('layouts.app')

@section('template_title')
{{ $componente->name ?? __('Show') . " " . __('Componente') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Componente</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('componentes.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

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
            </div>
        </div>
    </div>
</section>
@endsection
