<?php

namespace App\Http\Controllers;

use App\Models\adresses;
use App\Models\cart;
use App\Models\categories;
use App\Models\order_details;
use App\Models\orders;
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
            'user' => User::where('id' ,Auth::user()->id )->first(), 
            'enderecos' => adresses::where('user', Auth::user()->id)->get()
        ]);
    } 

    public function UpdateProfile(Request $request){

        $data = $request->only(['name', 'phone', 'email']);

        $user = User::where('id',Auth::user()->id)->first();

        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->name = $data['name'];

        $user->save();

        return redirect()->route('profile');
    }

    public function historicOrders(){

        $orders = orders::where('orders.user', Auth::user()->id)->get()->toArray();

        $pedidosFechados = [];

        $pedidosAbertos = [];

        foreach($orders as $order){

            $arr = [
                'info' => $order, 
                'items' => order_details::join('products', 'order_details.product', 'products.id')->where('order_details.order',$order['id'])
                ->select('order_details.quantity', 'order_details.price', 'products.id', 'products.name')->get()->toArray(), 
                'address' => adresses::where('user', Auth::user()->id)->where('id', $order['adress'])->first()->toArray()
            ];

            if( ($order['status'] == 'F') or ($order['status'] == 'X') ){

                $pedidosFechados[$order['id']] = $arr;

            }else if(($order['status'] == 'S') or ($order['status'] == 'C')){

                $pedidosAbertos[$order['id']] = $arr;
            }

        }
        
        return view('orders', [

            'pedidosFechados' => $pedidosFechados, 
            'pedidosAbertos' => $pedidosAbertos

        ]);
    }

}
