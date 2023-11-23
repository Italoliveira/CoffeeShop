<x-layouts.admin>

    <div class="h-28 bg-gray-200 rounded-md p-4 border-2 border-black">

        <div class="flex  items-center">

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">{{ $VendasMensais }}</span>
                <span>Vendas Mensais</span>
            </div>

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">$ {{ number_format($FaturamentoSemanal, 2) }} </span>
                <span>Faturamento Semanal </span>
            </div>

            <div class="flex flex-col w-1/3 justify-center items-center space-y-1">
                <span class="text-4xl font-bold">R$ {{ number_format($FaturamentoMensal, 2) }}</span>
                <span> Faturamento Mensal </span>
            </div>

        </div>

    </div>

    <div class="bg-gray-200 rounded-md p-4 border-2 border-black my-6 flex flex-col overflow-auto" style="height: calc(100vh - 32vh)">

        <h1 class="text-center font-semibold py-2 text-lg"> Relatorios de Diarios </h1>

        <div class="flex flex-col">

            @foreach ($reports as $report)

                @php
                    $data = new DateTime($report->data);
                @endphp

                <div class="bg-white rounded-sm shadow-white shadow-sm p-3 space-y-4 my-1 flex items-end">

                    <div class="flex flex-col justify-center items-center w-1/5">
                        <span class="text-sm font-semibold">Data</span>
                        <span class="text-lg">{{$data->format('d/m/Y')}}</span>
                    </div>
                    
                    <div class="flex flex-col justify-center items-center w-1/5">
                        <span class="text-sm font-semibold">Faturamento</span>
                        <span class="text-lg">R$ {{number_format($report->concluidos,2)}} </span>
                    </div>

                    <div class="flex flex-col justify-center items-center w-1/5">
                        <span class="text-sm font-semibold">N° de Pedidos</span>
                        <span class="text-lg"> {{$report->vendas}} </span>
                    </div>

                    <div class="flex flex-col justify-center items-center w-1/5">
                        <span class="text-sm font-semibold">Pedidos Cancelados </span>
                        <span class="text-lg"> {{$report->cancelados}} </span>
                    </div>

                    
                    <div class="flex flex-col justify-center items-center w-1/5">
                        <span class="text-sm font-semibold">Pedidos Concluidos </span>
                        <span class="text-lg"> {{$report->vendas - $report->cancelados }} </span>
                    </div>

                </div>

            @endforeach

        </div>

    </div>

</x-layouts.admin>