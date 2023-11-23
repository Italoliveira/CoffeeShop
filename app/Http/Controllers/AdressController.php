<?php

namespace App\Http\Controllers;

use App\Models\adresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Models\adresses

class AdressController extends Controller
{
    public function newAdress()
    {
        return view('Auth.adress');
    }

    public function registerAdress(Request $request)
    {

        $rules =  [
            'street' => 'required',
            'bairro' => 'required',
            'number' => 'required'
        ];

        $messages = [
            'street.required' => 'Endereço é um campo obrigatorio',
            'bairro.required' => 'Bairro é um campo obrigatorio',
            'number.required' => 'Numero é um campo obrigatorio',
        ];

        if ($validator = $request->validate($rules, $messages)) {

            $data = $request->only(['street', 'bairro', 'number', 'comp', 'page']);
            $add = new adresses();
            $add->user = Auth::user()->id;
            $add->street = $data['street'];
            $add->number = $data['number'];
            $add->neighborhood = $data['bairro'];
            $add->comp = ($data['comp']) ? $data['comp']  : '-';
            $add->city = 'São Paulo';
            $add->state = 'SP';

            if ($add->save()) {

                return  redirect()->route($data['page']);

            } else {

                return  redirect()->route('newAdress')->withErrors(['error' => 'Ocorreu um erro inesperado'])->withInput();
            }
            
        } else {

            return  redirect()->route('newAdress')->withErrors($validator)->withInput();
        }
    }

    public function deleteAdress(Request $request){

        $data = $request->only('id');
        $add = adresses::find($data['id'])->first();
        
        if($add->delete()){

            return redirect()->route('profile');

        }else{

            return redirect()->route('profile')->withErrors(['error' => "Ocorreu um problema Inexperado"]);
        }

    }
}
