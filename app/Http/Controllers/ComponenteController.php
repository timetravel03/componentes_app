<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComponenteRequest;
use App\Models\Categoria;
use App\Models\Estado;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $componente = new Componente();
        // Aquí las querys se realizan con otro propósito, para incluir todas 
        // las posibles opciones en un select en el fomulario de creación
        $categorias = Categoria::all();
        $estados = Estado::all();

        return view('componente.create', compact('componente', 'categorias', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComponenteRequest $request): RedirectResponse
    {
        Componente::create($request->validated());

        return Redirect::route('componentes.index')
            ->with('success', __('Componente created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $componente = Componente::find($id);
        // Aquí se hacen tambien para identificar los estados y componentes, 
        // pero como ya tenemos el id pues usamos find() para identificar solo los necesarios
        $estado = Estado::find($componente->estado_producto);
        $categoria = Categoria::find($componente->categoria_producto);

        return view('componente.show', compact('componente', 'estado', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $componente = Componente::find($id);
        // Misma razón que para el create(), para los selects del formulario
        $categorias = Categoria::all();
        $estados = Estado::all();

        return view('componente.edit', compact('componente', 'categorias', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComponenteRequest $request, Componente $componente): RedirectResponse
    {
        $componente->update($request->validated());

        return Redirect::route('componentes.index')
            ->with('success', __('Componente updated successfully'));
    }

    public function destroy($id): RedirectResponse
    {
        Componente::find($id)->delete();

        return Redirect::route('componentes.index')
            ->with('success', __('Componente deleted successfully'));
    }
}
