@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Estado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header bg-dark text-white">
                        <span class="card-title">{{ __('Create') }} Estado</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('estados.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('estado.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
