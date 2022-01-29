<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cdi extends Model
{
	protected $table = 'cdi';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];

	public static function  retorno_periodo(){
		$all = Cdi::all();
		$retornos = $all->where('ano',2018)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = implode(',', $retornos);
		$retornos = $all->where('ano',2019)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = $all->where('ano',2020)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = explode(',', $valores);
		$retornos = $all->where('ano',2021)
		->sortby('mes')->pluck('retorno_mensal')->toArray();
		$valores = $valores.','.implode(',', $retornos);
		$retornos = explode(',', $valores);

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
