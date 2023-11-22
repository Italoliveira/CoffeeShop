<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\categories;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffeeController extends Controller
{
    public function home(){

        $produtos = products::where('status','A')->get();
        $categorias = categories::all();

        return view('index', [
            'produtos' => $produtos,
            'categorias' => $categorias
        ]);
    }

    public function profile(){
        return view('profile');
    }


}
