<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
	protected $table = 'carteiras';
	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
	public function Empresa()
	{
		return $this->HasOne(Empresa::class, 'id', 'ativo_id');
	}
	public function Corretora()
	{
		return $this->HasOne(Corretora::class, 'id', 'corretora_id');
	}
	public function getNomeMesAttribute($value)
	{
		switch ($this->mes) {
			case "01":    $mes = 'Janeiro';     break;
			case "02":    $mes = 'Fevereiro';   break;
			case "03":    $mes = 'Março';       break;
			case "04":    $mes = 'Abril';       break;
			case "05":    $mes = 'Maio';        break;
			case "06":    $mes = 'Junho';       break;
			case "07":    $mes = 'Julho';       break;
			case "08":    $mes = 'Agosto';      break;
			case "09":    $mes = 'Setembro';    break;
			case "10":    $mes = 'Outubro';     break;
			case "11":    $mes = 'Novembro';    break;
			case "12":    $mes = 'Dezembro';    break; 
		}
		return $mes;
	}
	public function PrecoMes(){
		$precos = $this->Empresa->Precos;
		$precosMes = $precos->filter(function($value){
			return $value->data->month == $this->mes && $value->data->year == $this->ano;
		});
		return $precosMes->first();
	}
	public function precoUltimoMes(){
		$precoMes = $this->PrecoMes();
		if(!empty($precoMes)){
			$mes = $precoMes->data->subMonth(1)->month;
			$ano = $precoMes->data->subMonth(1)->year;
			$precos = $this->Empresa->Precos;
			$precosMes = $precos->filter(function($value) use ($ano, $mes){
				return $value->data->month == $mes && $value->data->year == $ano;
			});
			return $precosMes->first()->adjusted_close;
		}else{
			return 0;
		}


	}
}
