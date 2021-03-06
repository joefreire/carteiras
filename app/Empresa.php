<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresas';
	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
	public function Precos()
	{
		return $this->HasMany(Preco::class, 'ativo_id', 'id');
	}
}
