<?php

namespace Database\Seeders;

use App\Models\products;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['name' => 'Bolo na Taça', 'description' => 'Chocolate Branco e Morango', 'price' => '12.50', 'image' => 'Produtos/bolo-na-taca.jpg' , 'quantity_unit' => '300g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Capuccino', 'description' => 'Tradicional', 'price' => '8.00', 'image' => 'Produtos/capuccino.jpeg' , 'quantity_unit' => '250ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Cha Mate', 'description' => 'Tradicional', 'price' => '6.50', 'image' => 'Produtos/cha-mate.jpg' , 'quantity_unit' => '350ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Cheesecake de Oreo', 'description' => 'Delicia Gelada', 'price' => '14.00', 'image' => 'Produtos/cheesecake-oreo.jpg' , 'quantity_unit' => '400g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Chocotino', 'description' => 'Café com Chocolate', 'price' => '9.00', 'image' => 'Produtos/chocotino.jpg' , 'quantity_unit' => '250ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Cookies 10UN', 'description' => 'Tradicional', 'price' => '12.00', 'image' => 'Produtos/cookie-classico.jpg' , 'quantity_unit' => '70g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Croissant de Chocolate', 'description' => 'Tradicional', 'price' => '9.00', 'image' => 'Produtos/croissant-de-chocolate.jpg' , 'quantity_unit' => '150g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Croissant de Morango', 'description' => 'Chocolate Branco e Morango', 'price' => '9.00', 'image' => 'Produtos/croissant-de-morango.jpg' , 'quantity_unit' => '150g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Croissant de Presunto e Queijo', 'description' => 'Tradicional', 'price' => '9.00', 'image' => 'Produtos/croissant-presunto-e-queijo.jpg' , 'quantity_unit' => '150g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Café Expresso', 'description' => 'Tradicional', 'price' => '6.00', 'image' => 'Produtos/expresso.jpg' , 'quantity_unit' => '250ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Late de Abobora', 'description' => 'leite e abobora', 'price' => '10.00', 'image' => 'Produtos/late-de-abobora.jpg' , 'quantity_unit' => '250ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Café au Late', 'description' => 'Tradicional', 'price' => '8.00', 'image' => 'Produtos/late-normal.jpg' , 'quantity_unit' => '70g' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Pão de Queijo 3UN', 'description' => 'Tradicional', 'price' => '4.00', 'image' => 'Produtos/Pao-de-queijo.jpg' , 'quantity_unit' => '100g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Pudim de Leite', 'description' => 'Tradicional', 'price' => '9.00', 'image' => 'Produtos/pudim-leite.jpg' , 'quantity_unit' => '150g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Sanduiche Natural', 'description' => 'Tradicional', 'price' => '8.00', 'image' => 'Produtos/sanduiche-natural.jpeg' , 'quantity_unit' => '150g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Queijo Quente', 'description' => 'Tradicional', 'price' => '16.00', 'image' => 'Produtos/sanduiche-quente.jpg' , 'quantity_unit' => '400g' , 'status' => 'A' , 'category' => '2'],
            ['name' => 'Suco de Milho', 'description' => 'Tradicional', 'price' => '8.00', 'image' => 'Produtos/Suco-de-milho.jpg' , 'quantity_unit' => '350ml' , 'status' => 'A' , 'category' => '1'],
            ['name' => 'Suco de Laranja', 'description' => 'Tradicional', 'price' => '8.00', 'image' => 'Produtos/Suco-laranja.jpg' , 'quantity_unit' => '350ml' , 'status' => 'A' , 'category' => '1'],

        ];

        foreach($data as $produto){

            $datatime = Carbon::now()->format('Y-M-d H:m:s'); 

            $prod = new products();

            $prod->name = $produto['name'];
            $prod->description = $produto['name'];
            $prod->price = $produto['price'];
            $prod->image = $produto['image'];
            $prod->quantity_unit = $produto['quantity_unit'];
            $prod->status = $produto['status'];
            $prod->category = $produto['category'];
            $prod->created_at = $datatime;
            $prod->updated_at = $datatime;

            $prod->save();

        }

    }
}
