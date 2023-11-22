<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{

    public function login()
    {
        return view('Auth.login');
    }

    public function register(){

        return view('Auth.register');

    }

    public function auth(Request $request)
    {

        $data = $request->only(['email', 'password']);

        if ($usuario = User::where('email', $data['email'])->first()) {

            if (password_verify($data['password'], $usuario->password)) {

                Auth::attempt(['id' => $usuario->id, 'name' => $usuario->name, 'email' => $data['email'], 'password' => $data['password'], 'tier' => $usuario->tier]);

                return redirect()->route('home');

            }

        }

        return redirect()->route('login')->withErrors(['error' => 'Email ou Senha Invalida']);
        
    }

    public function registerClient(AuthRequest $request)
    {
        $data = $request->only(['name', 'phone', 'email', 'password']);

        $usuario = new User();

        $usuario->name = $data['name'];
        $usuario->phone = $data['phone'];
        $usuario->email = $data['email'];
        $usuario->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $usuario->tier = '1';

        if($usuario->save()){

            Auth::attempt(['id' => $usuario->id, 'name' => $usuario->name, 'email' => $data['email'], 'password' => $data['password'], 'tier' => $usuario->tier]);

            return redirect()->route('newAdress');

        }else{

            return redirect()->route('register')->withErrors(['error' => 'Ocorreu um erro inesperado']);

        }

    }

    public function registerAdmin(Request $request)
    {
        $data = $request->only(['teste']);

        return response()->json(['message' => $data['teste']]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
