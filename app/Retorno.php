<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retorno extends Model
{
	protected $table = 'retornos';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
	public function Corretora()
	{
		return $this->HasOne(Corretora::class, 'id', 'corretora_id');
	}
}
