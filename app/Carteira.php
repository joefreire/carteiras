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
		return $this->HasOne(Empresa::class, 'ativo', 'ticker');
	}
}
