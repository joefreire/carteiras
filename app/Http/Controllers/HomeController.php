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
            $data = Carteira::with('Empresa','Corretora')
            ->join('empresas', 'empresas.id', '=', 'carteiras.ativo_id')
            ->join('corretoras', 'corretoras.id', '=', 'carteiras.corretora_id')
            ->select('carteiras.*');

            return Datatables::of($data)->make(true);
        }
        
        return view('carteiras');
    }
}
