<x-layouts.auth>

    <div class="flex items-center justify-center h-screen">

        <form action="{{ route('registerClient') }}" method="POST"
            class="flex flex-col space-y-4 bg-gray-200 p-8 w-1/3 h-2/3 overflow shadow-sm shadow-neutral-200">

            @csrf

            <div class="flex justify-center items-center mb-10">
                <span class="logo-header-login text-5xl text-black">Coffee Shop</span>
            </div>

            <div class="flex flex-col space-y-2">
                <label class="text-sm font-semibold">Nome Comleto</label>
                <input type="text" name="name" id="name" class="border-2 border-black rounded-md h-10 p-4">
            </div>

            <div class="flex flex-col space-y-2">
                <label class="text-sm font-semibold">Email</label>
                <input type="email" name="email" id="email" class="border-2 border-black rounded-md h-10 p-4">
            </div>
            <div class="flex space-x-2">

                <div class="flex flex-col space-y-2 flex-1">
                    <label class="text-sm font-semibold">Senha</label>
                    <input type="password" name="password" id="password"
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>

                <div class="flex flex-col space-y-2 flex-1">
                    <label class="text-sm font-semibold">Telefone</label>
                    <input type="number" name="phone" id="phone"
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>

            </div>

            <div class="flex text-red-500 text-sm justify-center items-center">
                @if ($errors->any())

                    <span>{{$errors->first()}}</span>

                @endif
            </div>
            <div class="flex flex-col space-y-2">

                <input type="submit" value="Cadastrar"
                    class="rounded-xl h-10 bg-blue-600 hover:bg-blue-700 text-white hover:text-gray-200 font-semibold">

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm"><span> Já possui uma conta? <b>Acessar
                                aqui</b></span></a>
                </div>

            </div>


        </form>

    </div>



</x-layouts.auth>
