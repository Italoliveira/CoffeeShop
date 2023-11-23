<?php

namespace App\Http\Controllers;

use App\Models\adresses;
use App\Models\order_details;
use App\Models\orders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {

        $hoje = Carbon::now()->toDateString();

        $receitaDiaria = orders::whereDate('updated_at', $hoje)->where('status', 'F')->sum('total');

        $PedidosRealizados = orders::whereDate('created_at', $hoje)->get();

        $receitaConcluidos = orders::whereDate('updated_at', $hoje)->where('status', 'F')->count();

        $PedidosSolicitados = orders::where('status', 'S')->get();

        $ArraySolicitados = [];

        foreach ($PedidosSolicitados as $PedidoSolicitado) {

            $array = [

                'user' => User::where('id', $PedidoSolicitado->user)->select('name', 'email', 'phone')->first()->toArray(),
                'address' => adresses::where('id', $PedidoSolicitado->adress)->first()->toArray(),
                'info' =>  $PedidoSolicitado->toArray(),
                'items' => order_details::join('products', 'order_details.product', 'products.id')
                    ->select('order_details.quantity', 'products.name', 'products.price')->where('order', $PedidoSolicitado->id)->get()->toArray()
            ];



            $ArraySolicitados[$PedidoSolicitado->id] = $array;
        }

        $PedidosAndamento = orders::where('status', 'C')->get();

        $ArrayAndamento = [];

        foreach ($PedidosAndamento as $PedidoAndamento) {

            $array = [
                'user' => User::where('id', $PedidoAndamento->user)->select('name', 'email', 'phone')->first()->toArray(),
                'address' => adresses::where('id', $PedidoAndamento->adress)->first()->toArray(),
                'info' =>  $PedidoAndamento->toArray(),
                'items' => order_details::join('products', 'order_details.product', 'products.id')
                    ->select('order_details.quantity', 'products.name', 'products.price')->where('order', $PedidoAndamento->id)->get()->toArray()
            ];

            $ArrayAndamento[$PedidoAndamento->id] = $array;
        }

        return view('Admin.index', [

            'receitaDiaria' => $receitaDiaria,
            'PedidosRealizados' => $PedidosRealizados->count(),
            'receitaConcluidos' => $receitaConcluidos,
            'PedidosSolicitados' => $ArraySolicitados,
            'PedidosAndamentos' => $ArrayAndamento

        ]);
    }

    public function cancelOrder(Request $request)
    {

        if ($order = orders::where('id', $request->id )->first()) {

            
            $order->status = 'X';
            $order->save();

            return redirect()->route('orders');

        } else {

            return redirect()->route('orders')->withErrors([
                'error' => 'Ocorreu um erro inexperado'
            ]);
        }
    }

    public function confirmOrder(Request $request)
    {

        if ($order = orders::where('id', $request->id)->first()) {

            $order->status = 'C';
            $order->save();

            return redirect()->route('orders');
        } else {

            return redirect()->route('orders')->withErrors([
                'error' => 'Ocorreu um erro inexperado'
            ]);
        }
    }

    public function closedmOrder(Request $request)
    {

        if ($order = orders::where('id', $request->id)->first()) {

            $order->status = 'F';
            $order->save();

            return redirect()->route('orders');
        } else {

            return redirect()->route('orders')->withErrors([
                'error' => 'Ocorreu um erro inexperado'
            ]);
        }
    }

    public function Reports()
    {

        $primeiroDiaDoMes = intval(Carbon::now()->firstOfMonth()->format('Ymd'));
        $ultimoDiaDoMes = intval(Carbon::now()->endOfMonth()->format('Ymd'));

        $ultimoDiaDaSemana = intval(Carbon::now()->endOfWeek()->format('Ymd'));
        $primeiroDiaDaSemana =  intval(Carbon::now()->startOfWeek()->format('Ymd'));
        
        $VendasMes = 0;
        $FaturamentoSemanal = 0;
        $FaturamentoMensal = 0;

        $reports = DB::table('orders')
            ->select(
                DB::raw('DATE(updated_at) as data'),
                DB::raw('COUNT(*) as vendas'),
                DB::raw('SUM(CASE WHEN status = "F" THEN total ELSE 0 END) as concluidos'),
                DB::raw('COUNT(CASE WHEN status = "X" THEN 1 END) as cancelados')
            )->groupBy(DB::raw('DATE(updated_at)'))->orderBy('data', 'desc')->get()->toArray();
    

        foreach($reports as $report){

            $data =  intval( Carbon::parse($report->data)->format('Ymd') );

            if(($data >= $primeiroDiaDoMes) and ( $data <= $ultimoDiaDoMes)){

                $VendasMes = $VendasMes + $report->vendas;
                $FaturamentoMensal = $FaturamentoMensal + $report->concluidos;
            }

            if(($data >= $primeiroDiaDaSemana ) and ( $data <= $ultimoDiaDaSemana)){
                
                $FaturamentoSemanal = $FaturamentoSemanal + $report->concluidos;
            }

        }

        return view('admin.reports.index',[
            'reports' => $reports, 
            'VendasMensais' =>  $VendasMes, 
            'FaturamentoMensal' => $FaturamentoMensal, 
            'FaturamentoSemanal' => $FaturamentoSemanal
        ]);
    }
}
