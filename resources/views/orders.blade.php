<x-layouts.app>

    <div class="bg-gray-200 rounded-md p-4 border-2 border-black flex flex-col overflow-auto my-4 mx-28"
        style="height: calc(100vh - 23vh)">

        <h1 class="text-center text-2xl font-bold py-2 my-8"> Historico de Pedidos </h1>

        <div class="flex flex-col">

            @foreach ($pedidosAbertos as $pedido)
                @php
                    $data = new DateTime($pedido['info']['created_at']);
                    $horario = new DateTime($pedido['info']['updated_at']);
                @endphp

                <a href="#" onclick="ShowItems({{ $pedido['info']['id'] }})">

                    <div
                        class="bg-white hover:bg-gray-100 rounded-sm shadow-neutral-300 shadow-sm p-2 space-y-4 my-1 flex flex-col">
                        <div class="flex h-full flex-col space-y-4 space-x-2">

                            <div class="flex flex-col w-full h-full items-center">

                                <div class="flex w-full h-full items-center">

                                    <div x-data="blinkingDot()"
                                        class="text-center flex justify-start items-center px-8 w-1/12">
                                        <div x-show="isBlinking"
                                            class="inline-block w-4 h-4 bg-green-500 rounded-full animate-pulse"></div>
                                    </div>

                                    <div class="h-full w-1/12 bg-bl flex justify-start">
                                        <div class="font-semibold h-full flex flex-col justify-around items-center">
                                            <div class="text-sm font-normal">
                                                N° Pedido
                                            </div>
                                            <div>
                                                {{ sprintf('%03d', $pedido['info']['id']) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="font-semibold h-full w-1/6 flex flex-col justify-around items-center ">
                                        <div class="text-sm font-normal">
                                            Data
                                        </div>
                                        {{ $data->format('d/m/Y') }}
                                    </div>

                                    <div class="font-semibold h-full w-1/6 flex flex-col justify-around items-center ">
                                        <div class="text-sm font-normal">
                                           Ultima Atulização
                                        </div>
                                        {{ $horario->format('H:m:s') }}
                                    </div>

                                    <div class="font-semibold h-full w-1/6 flex flex-col justify-around items-center ">
                                        <div class="text-sm font-normal">
                                            Pagamento
                                        </div>
                                        <div>
                                            {{ $pedido['info']['payment'] }}
                                        </div>
                                    </div>

                                    <div class="font-semibold h-full w-1/6 flex flex-col justify-around items-center ">
                                        <div class="text-sm font-normal">
                                            Total
                                        </div>
                                        <div>
                                            R$ {{ number_format($pedido['info']['total'], 2) }}
                                        </div>
                                    </div>

                                    <div
                                        class="font-semibold text-md h-full w-1/6 flex flex-col justify-around items-center ">

                                        <div
                                            class="{{ $pedido['info']['status'] == 'C' ? 'text-blue-500' : 'text-amber-900' }}">
                                            {{ $pedido['info']['status'] == 'C' ? 'Confirmado' : 'Aguardando Confirmação' }}
                                        </div>

                                    </div>

                                </div>

                                <div class="w-full border-t-2 border-neutral-700 py-2 px-10 hidden flex flex-col"
                                    id="Details-{{ $pedido['info']['id'] }}">
                                    <div class="flex flex-col">
                                        <div>
                                            <h2><b>Endereço:</b> {{ $pedido['address']['street'] }} N°
                                                {{ $pedido['address']['number'] }}
                                                {{ $pedido['address']['comp'] != '-' ? $pedido['address']['comp'] : '' }} -
                                                {{ $pedido['address']['neighborhood'] }} </h2>
                                        </div>
                                        <ul>
                                            @if ($pedido['items'] != [])
                                                @foreach ($pedido['items'] as $item)
                                                    <li><b>{{ $item['quantity'] }}x</b> {{ $item['name'] }} </li>
                                                @endforeach
                                            @endif
                                        </ul>

                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </a>
            @endforeach

            @foreach ($pedidosFechados as $pedido)
                @php
                    $data = new DateTime($pedido['info']['created_at']);
                @endphp

                <a href="#" onclick="ShowItems({{ $pedido['info']['id'] }})">

                    <div
                        class="bg-white hover:bg-gray-100 rounded-sm shadow-neutral-300 shadow-sm p-2 space-y-4 my-1 flex flex-col">
                        <div class="flex h-full flex-col space-y-4 space-x-2">

                            <div class="flex w-full h-full items-center">
                                <div class="font-semibold h-full w-1/5 flex flex-col justify-around items-center">
                                    <div class="text-sm font-normal">
                                        N° Pedido
                                    </div>
                                    <div>
                                        {{ sprintf('%03d', $pedido['info']['id']) }}
                                    </div>
                                </div>

                                <div class="font-semibold h-full w-1/5 flex flex-col justify-around items-center ">
                                    <div class="text-sm font-normal">
                                        Data
                                    </div>
                                    {{ $data->format('d/m/Y') }}
                                </div>

                                <div class="font-semibold h-full w-1/5 flex flex-col justify-around items-center ">
                                    <div class="text-sm font-normal">
                                        Pagamento
                                    </div>
                                    <div>
                                        {{ $pedido['info']['payment'] }}
                                    </div>
                                </div>

                                <div class="font-semibold h-full w-1/5 flex flex-col justify-around items-center ">
                                    <div class="text-sm font-normal">
                                        Total
                                    </div>
                                    <div>
                                        R$ {{ number_format($pedido['info']['total'], 2) }}
                                    </div>
                                </div>

                                <div
                                    class="font-semibold text-lg h-full w-1/5 flex flex-col justify-around items-center ">
                                    <div
                                        class="{{ $pedido['info']['status'] == 'F' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $pedido['info']['status'] == 'F' ? 'Finalizado' : 'Cancelado' }}
                                    </div>
                                </div>
                            </div>

                            <div class="border-t-2 border-neutral-700 py-2 px-10 hidden flex flex-col"
                                id="Details-{{ $pedido['info']['id'] }}">
                                <div>
                                    <h2><b>Endereço:</b> {{ $pedido['address']['street'] }} N°
                                        {{ $pedido['address']['number'] }}
                                        {{ $pedido['address']['comp'] != '-' ? $pedido['address']['comp'] : '' }} -
                                        {{ $pedido['address']['neighborhood'] }} </h2>
                                </div>
                                <ul>
                                    @if ($pedido['items'] != [])
                                        @foreach ($pedido['items'] as $item)
                                            <li><b>{{ $item['quantity'] }}x</b> {{ $item['name'] }} </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                        </div>


                    </div>

                </a>
            @endforeach

        </div>

    </div>

    <script>
        const ShowItems = function($id) {
            var details = document.getElementById('Details-' + $id);

            if (details.classList.contains('hidden')) {

                details.classList.remove('hidden');
            } else {

                details.classList.add('hidden');

            }
        }

        const blinkingDot = function() {
            return {
                isBlinking: true,
            }
        };
    </script>


</x-layouts.app>
