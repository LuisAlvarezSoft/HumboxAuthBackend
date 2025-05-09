<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder {
    public function run() {
        DB::table('estados')->insert([
            ['name' => 'activo',   'description' => null],
            ['name' => 'inactivo', 'description' => null],
            ['name' => 'bloqueado','description' => null],
        ]);
    }
}
