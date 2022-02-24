<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ibovespa;
use App\Ipca;
use App\Cdi;
use MathPHP\Statistics\Descriptive;

class Corretora extends Model
{
	protected $table = 'corretoras';
	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
	public function retornos()
	{
		return $this->HasMany(Retorno::class, 'corretora_id', 'id');
	}
	public function retornoAnual($ano)
	{
		$retornos = $this->retornos->where('ano', $ano)->sortby('mes')->pluck('retorno_mensal')->toArray();
		$retorno_anual = self::retorno_anual($retornos);
		return $retorno_anual;
	}
	public function sharpe_periodo(){
		$retornos = $this->retornos->where('ano', '>=',2018)->where('ano', '<=',2021)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		if(count($retornos) == 0){
			return 0;
		}
		if(count($retornos) < 48){
			return 0;
		}
		$cdi = Cdi::all();
		$livre_risco = $cdi->pluck('retorno_mensal')->sortby('mes')->toArray();

		$retorno_anual = $this->retorno_periodo();
		if($retorno_anual == 0){
			return 0;
		}
		$retorno_anual_livre_risco = Cdi::retorno_periodo();
		$risco_ativo_livre_risco = Descriptive::standardDeviation($livre_risco);
		$risco_ativos = Descriptive::standardDeviation($retornos);

		$ISg = (($retorno_anual - $retorno_anual_livre_risco) / ($risco_ativos - $risco_ativo_livre_risco));
		return $ISg;

	}
	public function sortino_periodo(){
		$retornos = $this->retornos->where('ano', '>=',2018)->where('ano', '<=',2021)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		if(count($retornos) == 0){
			return 0;
		}
		$cdi = Cdi::all();
		$livre_risco = $cdi->pluck('retorno_mensal')->sortby('mes')->toArray();

		$retorno_anual = $this->retorno_periodo();
		if($retorno_anual == 0){
			return 0;
		}
		$retorno_anual_livre_risco = Cdi::retorno_periodo();
		$risco_ativos = Descriptive::standardDeviation($retornos);

		$ISg = (($retorno_anual - $retorno_anual_livre_risco) / $risco_ativos);
		return $ISg;

	}
	public function sharpe($ano){
		$retornos = $this->retornos->where('ano', $ano)->sortby('mes')->pluck('retorno_mensal')->toArray();
		if(count($retornos) == 0){
			return 0;
		}
		if(count($retornos) < 12){
			return 0;
		}
		$cdi = Cdi::where('ano', $ano)->get();
		$livre_risco = $cdi->pluck('retorno_mensal')->sortby('mes')->toArray();

		$retorno_anual = $this->retornoAnual($ano);
		if($retorno_anual == 0){
			return 0;
		}
		$retorno_anual_livre_risco = self::retorno_anual($livre_risco);

		$risco_ativo_livre_risco = Descriptive::standardDeviation($livre_risco);
		$risco_ativos = Descriptive::standardDeviation($retornos);


		$ISg = (($retorno_anual - $retorno_anual_livre_risco) / ($risco_ativos - $risco_ativo_livre_risco) );
		return $ISg;

	}
	public function sortino($ano){
		$retornos = $this->retornos->where('ano', $ano)->where('retorno_mensal','<',0)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		if(count($retornos) == 0){
			return 0;
		}
		$cdi = Cdi::where('ano', $ano)->get();
		$livre_risco = $cdi->pluck('retorno_mensal')->sortby('mes')->toArray();

		$retorno_anual = $this->retornoAnual($ano);
		if($retorno_anual == 0){
			return 0;
		}
		$retorno_anual_livre_risco = self::retorno_anual($livre_risco);

		$risco_ativo_livre_risco = Descriptive::standardDeviation($livre_risco);
		if(count($retornos) == 1){
			$risco_ativos = $retornos[0];
		}else{
			$risco_ativos = Descriptive::standardDeviation($retornos);
		}
		$ISOg = (($retorno_anual - $retorno_anual_livre_risco) / $risco_ativos );
		return $ISOg;

	}
	public function todo_perido(){
		$retornos = $this->retornos->where('ano', '>=',2018)->where('ano', '<=',2021)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		if(count($retornos) == 0){
			return false;
		}
		if(count($retornos) < 48){
			return false;
		}
		return true;
	}
	public static function retorno_anual($retornos){
		$retorno_anual = 0;
		if(empty($retornos)){
			return 0;
		}
		foreach($retornos as $key => $retorno){
			if($key == 0){
				$retorno_anual = $retorno;
			}else{
				$retorno_anual = (((1 + $retorno_anual)*(1+$retorno))-1);
			}
		}
		return $retorno_anual;
	}
	public function retorno_periodo(){
		$retornos = $this->retornos->where('ano',2018)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = implode(',', $retornos);
		$retornos = $this->retornos->where('ano',2019)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = $this->retornos->where('ano',2020)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = explode(',', $valores);
		$retornos = $this->retornos->where('ano',2021)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = explode(',', $valores);
		if(count($retornos) < 48){
			return 0;
		}
		$retorno_anual = 0;
		if(empty($retornos)){
			return 0;
		}
		foreach($retornos as $key => $retorno){
			if($key == 0){
				$retorno_anual = $retorno;
			}else{
				$retorno_anual = (((1 + $retorno_anual)*(1+$retorno))-1);
			}
		}
		return $retorno_anual;
	}

}
