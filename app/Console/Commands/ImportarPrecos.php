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

class ImportarPrecos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportarPrecos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa Precos das ações pelo alphavantage';

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
    	$key = 'COJ3DOLM5BH0B6KY';
    	$EmpresaComPrecos = Preco::groupBy('ativo_id')->pluck('ativo_id');
    	
    	$empresas = Empresa::whereNotIn('id', $EmpresaComPrecos->toArray())->get();

    	$this->output->progressStart(count($empresas));
    	foreach ($empresas as $empresa) {
    		$jsonurl = "https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY_ADJUSTED&symbol=" . urlencode($empresa->ticker) . ".SA&apikey=" . $key;
    		$jsonResponse = file_get_contents($jsonurl);
    		$jsonResponseDecode = json_decode($jsonResponse);

    		if(isset($jsonResponseDecode->{"Monthly Adjusted Time Series"})){
    			$valores = $jsonResponseDecode->{"Monthly Adjusted Time Series"};
    			foreach ($valores as $data => $valor) {
    				$preco = Preco::where('ativo_id', $empresa->id)
    				->where('data',$data)->first();
    				if(empty($preco)){
    					Preco::create([
    						'ativo_id'=>$empresa->id,
    						'data'=>$data,
    						'open'=>$valor->{"1. open"},
    						'high'=>$valor->{"2. high"},
    						'low'=>$valor->{"3. low"},
    						'close'=>$valor->{"4. close"},
    						'adjusted_close'=>$valor->{"5. adjusted close"},
    						'volume'=>$valor->{"6. volume"},
    						'dividend_amount'=>$valor->{"7. dividend amount"},
    					]);
    				}
    			}
    		}
    		echo "PRECOS ".$empresa->ticker;
    		sleep(20);
    		$this->output->progressAdvance();
    	}
    	$this->output->progressFinish();


    }

    public function converteMes($mes){
    	switch($mes) {
    		case 'Janeiro':
    		return 1;
    		break;
    		case 'Fevereiro':
    		return 2;            
    		break;
    		case 'Marco':
    		return 3;            
    		break;
    		case 'Março':
    		return 3;            
    		break;
    		case 'Abril':
    		return 4;            
    		break;
    		case 'Maio':
    		return 5;            
    		break;
    		case 'Junho':
    		return 6;
    		break;
    		case 'Julho':
    		return 7;            
    		break;
    		case 'Agosto':
    		return 8;
    		break;
    		case 'Setembro':
    		return 9;
    		break;
    		case 'Outubro':
    		return 10;
    		break;
    		case 'Novembro':
    		return 11;
    		break;
    		case 'Dezembro':
    		return 12;
    		break;
    	}
    }

}
