<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ibovespa extends Model
{
	protected $table = 'ibovespa';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];

}
