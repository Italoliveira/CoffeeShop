<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\categories;

class CategoriesSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = ['Bebidas', 'Sobremesas', 'Salgados']; 

        foreach($categorias as $categoria){

            $db = new categories();
            $db->name = $categoria;
            $db->save();
        }
    }
}
