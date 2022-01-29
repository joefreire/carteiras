<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipca extends Model
{
	protected $table = 'ipca';
	public $timestamps = false;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];

}
