<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.usuarios.index', [

            'users' => User::where('tier', 2)->get()

        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $rules = [
            'name' => 'required|min:6', 
            'password' => 'required|min:6|same:confirm_password', 
            'status' => 'required', 
            'email' => 'email|required|unique:users', 
            'confirm_password' => 'required', 
        ];

        $messages = [

            'required' => 'Todos os Campos são Obrigatorios',
            'name.min' => 'Preencha com seu nome completo',
            'password.same' => 'Os campos de senha devem ser iguais', 
            'email.email' => 'Email Invalido', 
            'email.uniqui' => 'Email já cadastrado'
        ];

        if($validator = $request->validate($rules, $messages)){

            $data = $request->only(['name', 'password', 'status', 'email', 'confirm_password']);

            $user = new User();

            $user->name = $data['name'];
            $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
            $user->status = $data['status'];
            $user->email = $data['email'];
            $user->tier = '2';
            $user->phone = '-';

            if($user->save()){

                return  redirect()->route('usuarios.index');

            }else{

                return  redirect()->route('usuarios.index')->withErrors(['error' => 'Ocorreu um erro inesperado'])->withInput();
            }

        }else{

            return redirect()->route('usuarios.index')->withErrors($validator)->withInput();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.usuarios.show',[

            'user' => User::where('id',$id)->first()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   

        $user = User::where('id', $id)->first();

        if($request->method() == 'PATCH' and $request->status){

            $user->status = $request->status;

            $user->save();
            return redirect()->route('usuarios.index');

        }else{

            return redirect()->route('usuarios.index');

        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {   

        $user = User::where('id',$id)->first();


        if( Auth::user()->id == $id){

            return redirect()->route('usuarios.index');

        }else{

            $user->delete();
            return redirect()->route('usuarios.index');

        }   
        
    }
}
