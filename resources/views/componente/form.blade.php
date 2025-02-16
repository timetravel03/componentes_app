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
