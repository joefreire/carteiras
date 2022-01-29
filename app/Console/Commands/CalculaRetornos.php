<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CarteirasImport;
use App\Imports\ExcelUtils;
use Maatwebsite\Excel\HeadingRowImport;
use App\Carteira;
use App\Corretora;
use App\Empresa;
use App\Preco;
use App\Retorno;
use DB;

class CalculaRetornos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CalculaRetornos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula Retornos das Carteiras';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    	$corretoras = Corretora::all();
    	$this->output->progressStart(count($corretoras));
    	foreach ($corretoras as $key => $corretora) {
    		for ($j=2015; $j < 2022; $j++) { 
    			for ($i=1; $i <= 12; $i++) { 
    				$total = 0;
    				$carteiras = Carteira::where('ano',$j)->where('mes',$i)
    				->where('corretora_id',$corretora->id)
    				->get();
    				foreach ($carteiras as $key=>$carteira) {                
    					$total = $total + $carteira->lucroMensalNumero();              
    				}
    				if(count($carteiras)>0){
    					$retorno = Retorno::firstOrCreate([
    						'ano'=>$carteira->ano,
    						'mes'=>$carteira->mes,
    						'corretora_id'=>$carteira->corretora_id,
    					],
    					[
    						'retorno_mensal'=>$total/count($carteiras)
    					]);
    				}
    			}
    		}
    		$this->output->progressAdvance();
    	}
    	$this->output->progressFinish();
    	
    }
}
