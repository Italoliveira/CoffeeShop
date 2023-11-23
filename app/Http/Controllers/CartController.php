<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use App\Models\adresses;
use App\Models\order_details;
use App\Models\orders;


class CartController extends Controller
{
    public function index()
    {


        $user = Auth::user()->id;

        $cart = cart::where('user', $user)->get();

        $items = 0;

        $enderecos = adresses::where('user', Auth::user()->id)->get();

        foreach ($cart as $i) {
            $items = $items + $i->quantity;
        }

        $produtos = cart::join('products', 'products.id', '=', 'carts.product')->where('user', $user)
            ->select('products.id', 'products.name', 'products.price', 'products.image', 'carts.quantity')->get();

        return view('cart', [
            'produtos' => $produtos,
            'items' => $items,
            'enderecos' => $enderecos
        ]);
    }

    public function addProduto(Request $request)
    {

        $data = $request->only('idProduto');
        $cart = new cart();
        $user = Auth::user()->id;

        if ($produto = cart::where('user', $user)->where('product', $data['idProduto'])->first()) {

            $produto->quantity = $produto->quantity + 1;

            $produto->save();
        } else {

            $cart->user = Auth::user()->id;
            $cart->product  = $data['idProduto'];
            $cart->quantity = 1;

            $cart->save();
        }

        return redirect()->route('home');
    }

    public function deleteProd(Request $request)
    {

        $data = $request->only('id');
        $produto = cart::where('user', Auth::user()->id)->where('product', $data['id'])->first();

        if ($produto->quantity >= 0) {

            $produto->quantity =  $produto->quantity - 1;
            $produto->save();
        }

        if ($produto->quantity <= 0) {
            $produto->delete();
        }

        return redirect()->route('historicOrders');
    }

    public function checkout(Request $request)
    {


        $data = $request->only(['payment', 'adress', 'total']);

        $user = Auth::user()->id;

        if (cart::where('user', $user )->count() > 0) {


            $produtos = cart::join('products', 'products.id', '=', 'carts.product')->where('user', $user)
            ->select('products.id', 'products.name', 'products.price', 'products.image', 'carts.quantity')->get();

            $total = 0;
            foreach ($produtos as $produto) {
                $total = $total + ($produto->price * $produto->quantity);
            }

            $orders = new orders();

            $orders->user = $user;
            $orders->total = $total;
            $orders->status = 'S';
            $orders->payment = $data['payment'];
            $orders->adress = $data['adress'];

            $orders->save();

            if ($id = $orders->id) {

                foreach ($produtos as $produto) {

                    $details = new order_details();

                    $details->order = $id;
                    $details->product = $produto->id;
                    $details->quantity = $produto->quantity;
                    $details->price = $produto->price;
                    $details->save();

                    $cart = cart::where('user', Auth::user()->id)->where('product', $produto->id)->first();

                    $cart->delete();
                }

                return redirect()->route('home');

            } else {

                return redirect()->route('cart')->withErrors(['Error' => 'Ocorreu um problema inexperado']);
            }

        } else {

            return redirect()->route('cart')->withErrors(['Error' => 'Carrinho vazio']);

        }
    }
}
