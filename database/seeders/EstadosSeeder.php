<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            'estado'=>'Nuevo'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Como Nuevo'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Usado pero funcional'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita revisión general'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita reparación'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Necesita piezas'
        ]);
        DB::table('estados')->insert([
            'estado'=>'Para el reciclaje'
        ]);
    }
}
