<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Componente
 *
 * @property $id
 * @property $modelo
 * @property $categoria_producto
 * @property $estado_producto
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Estado $estado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Componente extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['modelo', 'categoria_producto', 'estado_producto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'categoria_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'estado_producto', 'id');
    }
    
}
