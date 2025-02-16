@extends('layouts.app')

@section('template_title')
Componentes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Componentes') }}
                        </span>

                        <div class="float-right">
                            {{-- No te deja añadir nuevo componente si no hay categorias o estados --}}
                            @if($categorias->isNotEmpty() && $estados->isNotEmpty())
                                <a href="{{ route('componentes.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                            @else
                                <a href="{{ route('componentes.create') }}" class="btn btn-primary btn-sm float-right disabled" data-placement="left">
                            @endif
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Modelo</th>
                                    <th>Categoria Producto</th>
                                    <th>Estado Producto</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($componentes as $componente)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $componente->modelo }}</td>
                                    <td>{{ $categorias->firstWhere('id', $componente->categoria_producto)->categoria }}</td>
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
                        </table>
                    </div>
                </div>
            </div>
            {!! $componentes->withQueryString()->links() !!}
        </div>
    </div>
</div>
@endsection
