<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 *
 * @property $id
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Componente[] $componentes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function componentes()
    {
        return $this->hasMany(\App\Models\Componente::class, 'id', 'estado_producto');
    }
    
}
