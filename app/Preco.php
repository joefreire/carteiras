<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
	protected $table = 'precos';
	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
	protected $dates = [
		'data',
	];
}
