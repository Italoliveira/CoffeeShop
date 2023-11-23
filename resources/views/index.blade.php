<x-layouts.app>

    @foreach ($categorias as $categoria)

        <div class="my-10 mx-10">

            <div class="flex justify-center items-center h-14 my-16">

                <div class="subtitulo">
                    <h1>{{$categoria->name}}</h1>
                </div>
                
            </div>

            <div class="p-2 grid mx-auto grid-cols-4 gap-x-4 gap-y-6 ">
                
                    
                @foreach($produtos as $produto)

                    @if($produto->category == $categoria->id)
                        <x-home.card idProduto="{{$produto->id}}" asset="{{$produto->image}}" product="{{$produto->name}}" value="{{$produto->price}}"/>
                    @endif

                @endforeach

            </div>

        </div>

    @endforeach

</x-layouts.app>
