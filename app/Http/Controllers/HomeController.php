<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carteira;
use App\Corretora;
use App\Empresa;
use Yajra\DataTables\Html\Builder; 
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function carteiras(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax()){
            $data = Carteira::with('Empresa.Precos','Corretora')
            ->join('empresas', 'empresas.id', '=', 'carteiras.ativo_id')
            ->join('corretoras', 'corretoras.id', '=', 'carteiras.corretora_id')
            ->select('carteiras.*')
            ->when(!empty($request->corretora), function ($q) use ($request) {
                return $q->where('corretora_id', $request->corretora);
            })
            ->when(!empty($request->mes_inicio), function ($q) use ($request) {
                return $q->where('mes', '>=', $request->mes_inicio);
            })
            ->when(!empty($request->ano_inicio), function ($q) use ($request) {
                return $q->where('ano', '>=', $request->ano_inicio);
            })
            ->when(!empty($request->ano_fim), function ($q) use ($request) {
                return $q->where('ano', '<=', $request->ano_fim);
            })
            ->when(!empty($request->mes_fim), function ($q) use ($request) {
                return $q->where('mes', '<=', $request->mes_fim);
            });
            return Datatables::of($data)
            ->addColumn('NomeMes', function ($lista) {
                return $lista->NomeMes;
            })
            // ->addColumn('UltimoPreco', function ($lista) {
            //     return $lista->precoUltimoMes();
            // })
            ->addColumn('PrecoMes', function ($lista) {
                $precoMes = $lista->precoMes();
                return !empty($precoMes) ? $precoMes->adjusted_close : 'Sem info';
            })
            ->addColumn('Retorno', function ($lista) {
                return $lista->lucroMensal();
            })
            ->toJson();
        }
        
        return view('carteiras');
    }
    public function resultados(Request $request)
    {
        if($request->ajax()){
            $resultado = collect();
            $data = Carteira::with('Empresa.Precos','Corretora')
            ->join('empresas', 'empresas.id', '=', 'carteiras.ativo_id')
            ->join('corretoras', 'corretoras.id', '=', 'carteiras.corretora_id')
            ->select('carteiras.*')
            //->where('corretora_id',7)
            ->where('ano','>', 2017)
            //->where('mes', '<', 3)
            ->when(!empty($request->corretora), function ($q) use ($request) {
                return $q->where('corretora_id', $request->corretora);
            })
            ->when(!empty($request->mes_inicio), function ($q) use ($request) {
                return $q->where('mes', '>=', $request->mes_inicio);
            })
            ->when(!empty($request->ano_inicio), function ($q) use ($request) {
                return $q->where('ano', '>=', $request->ano_inicio);
            })
            ->when(!empty($request->ano_fim), function ($q) use ($request) {
                return $q->where('ano', '<=', $request->ano_fim);
            })
            ->when(!empty($request->mes_fim), function ($q) use ($request) {
                return $q->where('mes', '<=', $request->mes_fim);
            })->get();

            $agrupado = $data->groupBy(function($item, $key){
                return $item["mes"]."/".$item["ano"];
            });
            foreach ($agrupado as $mesAno => $carteiras) {
                $carteiraPorCorretoraMes = $carteiras->groupBy('corretora_id');
                
                foreach ($carteiraPorCorretoraMes as $ativos) {
                    $valor = 0;
                    $ativosEmLinha = '';
                    foreach ($ativos as $key => $ativo) {
                        $valor = $valor + $ativo->lucroMensalValor();
                        if($key == 0){
                            $ativosEmLinha = $ativo->Empresa->ticker;
                        }else{
                            $ativosEmLinha = $ativosEmLinha.','.$ativo->Empresa->ticker;
                        }
                        
                    }  
                    $resultado
                    ->push(['corretora_id' => $ativos->first()->corretora_id,
                        'resultado' => round($valor/count($ativos), 2),
                        'mes' => $ativos->first()->mes,
                        'ano' => $ativos->first()->ano,
                        'periodo' => $mesAno,
                        'ativos' => $ativosEmLinha,
                        'primeiroAtivo' => $ativos->first(),
                        'corretora' => $ativos->first()->corretora->nome,
                    ]);  
                }
            }
            //dd($resultado);
            return Datatables::of($resultado)
            ->toJson();
        }
        
        return view('carteirasResultados');
    }
    public function novaCarteira()
    {               
        return view('novaCarteiras');
    }
    public function salvaCarteira(Request $request)
    {        
        $request->validate([
            'mes' => 'required',
            'ano' => 'required',
            'corretora_id' => 'required',
            'empresa_id' => 'required',
        ]);
        $carteiras = Carteira::where('mes',$request->mes)
        ->where('ano',$request->ano)
        ->where('corretora_id',$request->corretora_id)->delete();

        foreach ($request->empresa_id as $empresa) {
            Carteira::create([
                'mes' => $request->mes,
                'ano' => $request->ano,
                'corretora_id' => $request->corretora_id,
                'ativo_id' => $empresa,
            ]);
        }     

        return redirect()->back()->with('sucess', 'salvo');
    }
    public function checkCarteira(Request $request)
    {        
        $request->validate([
            'mes' => 'required',
            'ano' => 'required',
            'corretora_id' => 'required',
        ]);
        $carteiras = Carteira::where('mes',$request->mes)
        ->where('ano',$request->ano)
        ->where('corretora_id',$request->corretora_id)->get();
        return $carteiras->pluck('ativo_id');
    }
}
