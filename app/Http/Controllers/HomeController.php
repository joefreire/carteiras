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
}
