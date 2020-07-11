<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretora extends Model
{
	protected $table = 'corretoras';
	public $timestamps = true;
	protected $primaryKey = 'id';
	protected $guarded = [
		'id'
	];
}
