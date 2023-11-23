<x-layouts.app>

    <div class="container mx-auto mt-10 pb-20">
        <div class="flex shadow-md my-10">
          <div class="w-3/4 bg-white px-10 py-10">

            <div class="flex justify-between border-b pb-8">
              <h1 class="font-semibold text-2xl">Carrinho</h1>
              <h2 class="font-semibold text-2xl"> {{$items}} Items</h2>
            </div>

            <div class="flex mt-10 mb-5">
              <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Produto</h3>
              <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 ">Quantidade</h3>
              <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Preço</h3>
              <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 ">Total</h3>
            </div>

            @foreach($produtos as $produto)

                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">

                <div class="flex w-2/5"> 
                    <div class="w-32">
                    <img class="h-24 w-28" src="{{ asset('storage/' . $produto->image) }}">
                    </div>
                    <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="font-bold text-sm">{{$produto->name}}</span>
                      <form action="{{route('cart.deleteProd')}}" method="post" id="formDeleteProd-{{$produto->id}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$produto->id}}">
                        <a href="#" class="font-semibold hover:text-red-500 text-gray-500 text-xs"
                        onclick="document.getElementById('formDeleteProd-{{$produto->id}}').submit()">Remove</a>
                      </form>
                    </div>
                </div>

                <div class="flex justify-center w-1/5">
                  
                  <span>{{$produto->quantity}}</span>

                </div>

                <span class="text-center w-1/5 font-semibold text-sm">R$ <span id="price-{{number_format($produto->id,2)}}">{{$produto->price}}</span></span>
                <span class="text-center w-1/5 font-semibold text-sm">R$ <span id="total-{{$produto->id}}">{{number_format(($produto->price * $produto->quantity),2)}}</span></span>

                </div>

            @endforeach
    
    

    
            <a href="{{route('home')}}" class="flex font-semibold text-indigo-600 text-sm mt-10">
          
              <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
              Continuar comprando
            </a>
          </div>
    
          <div id="summary" class="w-1/4 px-8 py-10">
            <h1 class="font-semibold text-2xl border-b pb-8">Ordem de Compra</h1>
            <div class="flex justify-between mt-10 mb-5"></div>

            <form action="{{route('cart.checkout')}}" method="post">
              @csrf
            <div>
                <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Endereço</label>

                <select class="block p-2 text-gray-600 w-full text-sm" name="adress">
                  @foreach($enderecos as $endereco)
                     <option value="{{$endereco->id}}"> {{$endereco->street}}, N° {{$endereco->number}} {{$endereco->comp}} - {{$endereco->neighborhood}} </option>
                  @endforeach
                </select>

              </div>

            <div class="py-10">
              <label class="font-medium inline-block mb-3 text-sm uppercase">Forma de Pagamento</label>
              <select class="block p-2 text-gray-600 w-full text-sm" name="payment">
                <option value="Dinheiro">Dinheiro</option>
                <option value="Pix">Pix</option>
                <option value="Pix">Cartão de Credito/Debito</option>
              </select>
            </div>
         

           <div class="border-t mt-8">

              <div class="flex font-semibold justify-between py-6 text-sm uppercase">

                <span>Total cost</span>

                <span>R$ <span id="total">
                  @php
                    $total = 0;
                    foreach ($produtos as $prod) {
                      $total = $total + ($produto->price * $produto->quantity);
                    }

                    echo number_format($total,2);
                     
                  @endphp
                  
                </span></span>
              </div>
              <input type="submit" value="Finalizar" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">
              
            </form> 
            </div>
          </div>
    
        </div>
      </div>
    
</x-layouts.app>