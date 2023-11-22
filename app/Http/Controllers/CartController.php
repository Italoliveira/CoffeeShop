<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use App\Models\adresses;

class CartController extends Controller
{
    public function index(){

        
        $user = Auth::user()->id; 

        $cart = cart::where('user', $user)->get();
        
        $items = 0;

        $enderecos = adresses::where('user', Auth::user()->id)->get();

        foreach ($cart as $i) {
            $items = $items + $i->quantity;
        }

        $produtos = cart::join('products', 'products.id','=','carts.product')->where('user', $user)
        ->select('products.id', 'products.name','products.price','products.image','carts.quantity')->get();

        return view('cart', [
            'produtos' => $produtos, 
            'items' => $items, 
            'enderecos' => $enderecos
        ]);
    }

    public function addProduto(Request $request){

        $data = $request->only('idProduto');
        $cart = new cart();
        $user = Auth::user()->id; 

        if($produto = cart::where('user', $user)->where('product',$data['idProduto'])->first()){

            $produto->quantity = $produto->quantity + 1;

            $produto->save();

        }else{

            $cart->user = Auth::user()->id; 
            $cart->product  = $data['idProduto'];
            $cart->quantity = 1;
            
            $cart->save();
        }

        return redirect()->route('home');
        
    }

    public function deleteProd(Request $request){

        $data = $request->only('id');
        $produto = cart::where('user', Auth::user()->id)->where('product', $data['id'])->first();

        if($produto->quantity <= 0){

            $produto->delete();

        }else{
            $produto->quantity =  $produto->quantity - 1;
            $produto->save();
        }

        return redirect()->route('cart');
    }

    public function checkout(){


    }
}
