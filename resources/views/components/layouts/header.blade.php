
    @php

        use Illuminate\Support\Facades\Auth;
        use App\Models\cart;

        if(Auth::check()){
             
        $user = Auth::user()->id;

        $cart = cart::where('user', $user)->get();
        
        $items = 0;

            foreach ($cart as $i) {
                $items = $items + $i->quantity;
            }
        }

    @endphp

<header class="h-20 bg-neutral-900 flex shadow-md shadow-black">

    <div class="w-1/6 flex justify-start items-center px-10">
        <a href="{{ route('home') }}">
            <span class="logo-header text-4xl ">Coffee Shop</span>
        </a>
    </div>

    <div class="flex flex-1 justify-end items-center px-10">

        @auth


            <a href="{{ route('logout') }}">
                <span class="px-5 font-bold text-white"> {{ Auth::user()->name }} </span>
            </a>

            <a href="{{ route('cart') }}" class="px-2 h-full flex justify-center items-center">

                <div class="absolute bg-blue-300 rounded-full h-6 w-6 ml-8 mb-8">
                    <span class="font-bold w-full h-full flex justify-center items-center">{{$items}}</span>
                </div>
    
                <x-icons.cart color="white" height="30px" />
    
            </a>

            
        <div class="px-2">
            <x-icons.help color="white" height="30px" />
        </div>

        @endauth

        @guest

            <a href="{{ route('login') }}">
                <span class="px-5 font-bold text-white"> Faça o login ou Cadastre-se</span>
            </a>

        @endguest

    </div>

</header>
