<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      DB::table('states')->truncate();
      DB::table('states')->insert(['name' => 'Amazonas']);
      DB::table('states')->insert(['name' => 'Antioquia']);
      DB::table('states')->insert(['name' => 'Arauca']);
      DB::table('states')->insert(['name' => 'Atlántico']);
      DB::table('states')->insert(['name' => 'Bolívar']);
      DB::table('states')->insert(['name' => 'Boyacá']);
      DB::table('states')->insert(['name' => 'Caldas']);
      DB::table('states')->insert(['name' => 'Caquetá']);
      DB::table('states')->insert(['name' => 'Casanare']);
      DB::table('states')->insert(['name' => 'Cauca']);
      DB::table('states')->insert(['name' => 'Cesar']);
      DB::table('states')->insert(['name' => 'Chocó']);
      DB::table('states')->insert(['name' => 'Córdoba']);
      DB::table('states')->insert(['name' => 'Cundinamarca']);
      DB::table('states')->insert(['name' => 'Güainia']);
      DB::table('states')->insert(['name' => 'Guaviare']);
      DB::table('states')->insert(['name' => 'Huila']);
      DB::table('states')->insert(['name' => 'La Guajira']);
      DB::table('states')->insert(['name' => 'Magdalena']);
      DB::table('states')->insert(['name' => 'Meta']);
      DB::table('states')->insert(['name' => 'Nariño']);
      DB::table('states')->insert(['name' => 'Norte de Santander']);
      DB::table('states')->insert(['name' => 'Putumayo']);
      DB::table('states')->insert(['name' => 'Quindo']);
      DB::table('states')->insert(['name' => 'Risaralda']);
      DB::table('states')->insert(['name' => 'San Andrés y Providencia']);
      DB::table('states')->insert(['name' => 'Santander']);
      DB::table('states')->insert(['name' => 'Sucre']);
      DB::table('states')->insert(['name' => 'Tolima']);
      DB::table('states')->insert(['name' => 'Valle del Cauca']);
      DB::table('states')->insert(['name' => 'Vaupés']);
      DB::table('states')->insert(['name' => 'Vichada']);
    }
}
