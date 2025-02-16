<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
