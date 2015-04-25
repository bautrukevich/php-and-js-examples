<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

	protected $fillable = [
		'name',
		'age',
		'size',
		'user_id'
	];

	public function visits()
	{
		return $this->hasMany('App\Visit');
	}

	public function users()
	{
		return $this->hasMany('App\User');
	}

}
