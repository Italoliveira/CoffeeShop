<x-layouts.app>

    {{-- <x-home.carroseul/> --}}

    @foreach ($categorias as $categoria)

        <div class="my-10 mx-10">

            <div class="flex justify-center items-center h-14 my-5">

                <div class="subtitulo">
                    <h1>{{$categoria->name}}</h1>
                </div>
                
            </div>

            <div class="p-2 grid grid-cols-5 gap-x-2 gap-y-4 justify-between">

                @foreach($produtos as $produto)

                    @if($produto->category == $categoria->id)
                        <x-home.card idProduto="{{$produto->id}}" asset="{{$produto->image}}" product="{{$produto->name}}" value="{{$produto->price}}"/>
                    @endif

                @endforeach

            </div>

        </div>

    @endforeach

</x-layouts.app>
