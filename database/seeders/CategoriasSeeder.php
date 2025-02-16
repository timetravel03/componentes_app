<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
