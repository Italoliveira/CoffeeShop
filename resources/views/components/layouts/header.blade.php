@php

    use Illuminate\Support\Facades\Auth;
    use App\Models\cart;

    if (Auth::check()) {
        $user = Auth::user()->id;

        $cart = cart::where('user', $user)->get();

        $items = 0;

        foreach ($cart as $i) {
            $items = $items + $i->quantity;
        }

        if (Auth::user()->tier == '2') {

            $rotas = ['Admin' => 'orders', 'Sair' => 'logout'];

        } else {
            
            $rotas = ['Perfil' => 'profile', 'Pedidos' => 'historicOrders', 'Sair' => 'logout'];

        }
    }

@endphp

<header class="h-20 bg-neutral-900 flex shadow-md shadow-black">

    <div class="w-1/6 flex justify-start items-center px-10">
        <a href="{{ route('home') }}">
            <span class="logo-header text-4xl ">Coffee Shop</span>

        </a>

    </div>

    <div class="flex flex-1 justify-end items-center px-12">

        @auth

            <div x-data="{ open: false }" class="relative inline-block text-left">

                <button @click="open = !open" class="text-white px-4 py-2 focus:outline-none rounded-full ml-4">
                    <x-icons.user />
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute mt-2 w-36 p-2 bg-white border rounded shadow-lg">

                    @foreach ($rotas as $key => $value)
                        <a href="{{ route($value) }}"
                            class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">{{ $key }}</a>
                    @endforeach

                </div>

            </div>

            <a href="{{ route('cart') }}" class=" h-full flex justify-center items-center" style="margin-left: -10px">

                <div class="absolute bg-blue-300 rounded-full h-6 w-6 ml-8 mb-8">
                    <span class="font-bold w-full h-full flex justify-center items-center">{{ $items }}</span>
                </div>

                <x-icons.cart color="white" height="30px" />

            </a>

        @endauth

        @guest

            <a href="{{ route('login') }}">
                <span class="px-5 font-bold text-white"> Faça o login ou Cadastre-se</span>
            </a>

        @endguest

    </div>

</header>
