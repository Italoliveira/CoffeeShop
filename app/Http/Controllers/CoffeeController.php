<?php

namespace App\Http\Controllers;

use App\Models\adresses;
use App\Models\cart;
use App\Models\categories;
use App\Models\products;
use App\Models\User;
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
        
        return view('profile', [
            'user' => User::find(Auth::user()->id)->first(), 
            'enderecos' => adresses::where('user', Auth::user()->id)->get()
        ]);
    }

    public function UpdateProfile(Request $request){

        $data = $request->only(['name', 'phone', 'email']);

        $user = User::find(Auth::user()->id)->first();

        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->name = $data['name'];

        $user->save();

        return redirect()->route('profile');
    }


}
