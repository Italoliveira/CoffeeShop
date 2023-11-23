<x-layouts.admin>
    <div class="h-28 bg-gray-200 rounded-md p-4 border-2 border-black">

        <div class="flex  items-center">

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">{{ $PedidosRealizados }}</span>
                <span>Pedidos Solicitados</span>
            </div>

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">{{ $receitaConcluidos }}</span>
                <span>Pedidos Concluidos</span>
            </div>

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">R$ {{ number_format($receitaDiaria, 2) }}</span>
                <span>Receita</span>
            </div>

        </div>

    </div>

    <div class="flex mt-10 space-x-2">

        <div class="bg-gray-200 rounded-md p-4 border-2 border-black w-1/2 space-y-4">

            <h1 class="text-center font-semibold"> Solicitações de Pedidos </h1>

            <div class="space-y-2">

                @foreach ($PedidosSolicitados as $PedidoSolicitado)

                    <form action="{{ route('cancelOrder') }}" method="post"
                        id="cancel-order-{{ $PedidoSolicitado['info']['id'] }}">
                        @csrf
                        <input type="hidden" name="id" id="id-{{ $PedidoSolicitado['info']['id'] }}"
                            value="{{ $PedidoSolicitado['info']['id'] }}">

                    </form>

                    <form action="{{route('confirmOrder')}}" method="post" id="confirm-order-{{ $PedidoSolicitado['info']['id'] }}">
                        @csrf
                        <input type="hidden" name="id" id="id-{{ $PedidoSolicitado['info']['id'] }}"
                        value="{{ $PedidoSolicitado['info']['id'] }}">
                    </form>

                    <div class="bg-white rounded-sm shadow-white shadow-sm p-3 space-y-2">

                        <div class="flex items-center">
                            <div class="w-1/6 font-semibold">

                                N° {{ $PedidoSolicitado['info']['id'] }}

                            </div>

                            <div class="w-1/3 text-sm">
                                {{ $PedidoSolicitado['user']['name'] }}
                            </div>

                            <div class="w-1/6">
                                R$ {{ number_format($PedidoSolicitado['info']['total'], 2) }}
                            </div>

                            <div class="w-1/6 font-semibold">
                                {{ date('H:i', strtotime(date($PedidoSolicitado['info']['created_at']))) }}
                            </div>

                            <div class="w-1/6 flex items-center justify-end space-x-1">



                                <a href="#"
                                    class="flex items-center justify-center rounded-md h-6 w-6 bg-blue-300 mr-4"
                                    onclick="ShowDetails({{ $PedidoSolicitado['info']['id'] }})"
                                    id="btn-ShowDetails-{{ $PedidoSolicitado['info']['id'] }}">
                                    <x-icons.eye />
                                </a>



                                <a href="#" class="flex items-center justify-center rounded-md h-6 w-6 bg-red-500"
                                    onclick="cancelOrder('{{ $PedidoSolicitado['info']['id'] }}')">
                                    <x-icons.cancel />
                                </a>

                                <a href="#"
                                    class="flex items-center justify-center rounded-md h-6 w-6 bg-green-500" onclick="document.getElementById('confirm-order-{{ $PedidoSolicitado['info']['id'] }}').submit()">
                                    <x-icons.check />
                                </a>

                            </div>
                        </div>

                        <div class="hidden p-4" id="details-{{ $PedidoSolicitado['info']['id'] }}">

                            <div class="w-1/2">

                                <ul>

                                    @foreach ($PedidoSolicitado['items'] as $PedidosAndamento)
                                        <li><b>{{ $PedidosAndamento['quantity'] }}x</b>
                                            {{ $PedidosAndamento['name'] }}</li>
                                    @endforeach

                                </ul>

                            </div>

                            <div class="w-1/2 flex justify-center items-center flex-col">
                                <h2 class="text-center"><b>Endereço</b></h2>
                                <h6>{{ $PedidoSolicitado['address']['street'] }}, N°
                                    {{ $PedidoSolicitado['address']['number'] }}
                                    {{ $PedidoSolicitado['address']['comp'] == '-' ? '' : $PedidoSolicitado['address']['comp'] }}
                                    - {{ $PedidoSolicitado['address']['neighborhood'] }}</h6>
                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

        <div class="bg-gray-200 rounded-md p-4 border-2 border-black w-1/2 overflow-auto space-y-4 scrollbar-thin"
            style="height: calc(100vh - 250px)">

            <h1 class="text-center font-semibold"> Pedidos em Andamento </h1>

            <div class="space-y-2">

                @foreach ($PedidosAndamentos as $PedidosAndamento)
                    <form action="{{ route('cancelOrder') }}" method="post"
                        id="cancel-order-{{ $PedidosAndamento['info']['id'] }}">
                        <input type="hidden" name="id" value="{{ $PedidosAndamento['info']['id'] }}">
                        @csrf
                    </form>

                    <form action="{{route('closedmOrder')}}" method="post" id="closed-order-{{ $PedidosAndamento['info']['id'] }}">
                        @csrf
                        <input type="hidden" name="id" id="id-{{ $PedidosAndamento['info']['id'] }}"
                        value="{{ $PedidosAndamento['info']['id'] }}">
                    </form>

                    <div class="bg-white rounded-sm shadow-white shadow-sm px-5  py-5 space-y-4">
                        <div class="flex items-center">
                            <h2 class="w-2/3"><b>N° {{ sprintf('%05d', $PedidosAndamento['info']['id']) }}</b></h2>
                            <div class="flex space-x-2 w-1/3">

                                <a href="#"
                                    class="flex items-center justify-center rounded-md h-8 w-24 p-2 bg-red-500"
                                    onclick="cancelOrder({{ $PedidosAndamento['info']['id'] }})">
                                    <span class="text-sm font-semibold">Cancelar</span>
                                </a>

                                <a href="#"
                                    class="flex items-center justify-center rounded-md h-8 w-24 p-2 bg-green-500">
                                    <span class="text-sm font-semibold" onclick="document.getElementById('closed-order-{{ $PedidosAndamento['info']['id'] }}').submit()">Enviar</span>
                                </a>

                            </div>
                        </div>

                        <div class="flex">

                            <div class="w-2/3 flex flex-col text-sm">

                                <span> <b>Cliente: </b> {{ $PedidosAndamento['user']['name'] }} </span>
                                <span>
                                    <b>Endereço: </b> {{ $PedidosAndamento['address']['street'] }}, N°
                                    {{ $PedidosAndamento['address']['number'] }}
                                    {{ $PedidosAndamento['address']['comp'] == '-' ? '' : $PedidosAndamento['address']['comp'] }}
                                    - {{ $PedidosAndamento['address']['neighborhood'] }}
                                </span>
                                <span> <b>Telefone:
                                    </b>{{ sprintf('(%s) %s-%s', substr($PedidosAndamento['user']['phone'], 0, 2), substr($PedidosAndamento['user']['phone'], 2, 5), substr($PedidosAndamento['user']['phone'], 7)) }}</span>
                                <span> <b>Pagamento: </b> {{ $PedidosAndamento['info']['payment'] }} </span>

                            </div>

                            <div class="w-1/3">

                                <ul>
                                    @foreach ($PedidosAndamento['items'] as $item)
                                             <li><b>{{$item['quantity']}}x</b> {{$item['name']}} </li>
                                    @endforeach
                                    


                                </ul>

                            </div>

                        </div>

                        <div class="flex justify-between items-center border-t border-neutral-700">
                            <span class="text-lg font-bold px-2 py-1">Total:</span>
                            <span class="text-lg font-semibold px-2 py-1">R$ {{number_format($PedidosAndamento['info']['total'] ,2 )}}</span>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>


    </div>

    <script>
        const ShowDetails = function($id) {

            var details = document.getElementById('details-' + $id);

            if (details.classList.contains('flex')) {

                details.classList.add('hidden');
                details.classList.remove('flex');
            } else {

                details.classList.add('flex');
                details.classList.remove('hidden')

            }
        }

        const cancelOrder = function($id) {

            if (confirm('Deseja cancelar o pedido N° ' + $id + '?')) {
                document.getElementById('cancel-order-' + $id).submit();
            }


        }

    </script>

</x-layouts.admin>
