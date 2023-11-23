<x-layouts.auth>

    <div class="flex items-center justify-center h-screen">

        <form action="{{ route('registerAdress') }}" method="POST"
            class="flex flex-col space-y-4 bg-gray-200 p-8 w-2/5 h-2/3 overflow shadow-sm shadow-neutral-200">

            @csrf
            
            <input type="hidden" name="page" value="home">

            <div class="flex justify-center items-center pb-10">
                <span class="logo-header-login text-5xl text-black">Coffee Shop</span>
            </div>

            <div class="flex space-x-2">

                <div class="flex flex-col space-y-2 flex-1">
                    <label class="text-sm font-semibold">Endereço</label>
                    <input type="text" name="street" id="street" value="{{old('street')}}"
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>

            </div>

            <div class="flex space-x-2">
                
                <div class="flex flex-col space-y-2  w-2/5">
                    <label class="text-sm font-semibold">Bairro</label>
                    <input type="text" name="bairro" id="bairro" value="{{old('bairro')}}"
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>

                <div class="flex flex-col space-y-2  w-1/5">
                    <label class="text-sm font-semibold">Numero</label>
                    <input type="number" name="number" id="number" value="{{old('number')}}"
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>

                <div class="flex flex-col space-y-2  w-2/5">
                    <label class="text-sm font-semibold">Complemento</label>
                    <input type="text" name="comp" id="comp" 
                        class="border-2 border-black rounded-md h-10 p-4">
                </div>



            </div>

            <div class="flex text-red-500 text-sm justify-center items-center h-10">

                @if ($errors->any())

                    <span>{{$errors->first()}}</span>

                @endif

            </div>

            <div class="flex flex-col space-y-2">

                <input type="submit" value="Cadastrar"
                    class="rounded-xl h-10 bg-blue-600 hover:bg-blue-700 text-white hover:text-gray-200 font-semibold">

                <div class="text-center text-gray-400 hover:text-gray-300 font-bold pb-12">
                    <a href="{{ route('home') }}" class="text-sm"><span>Deseja pular a etapa</b></span></a>
                </div>

            </div>


        </form>

    </div>



</x-layouts.auth>

