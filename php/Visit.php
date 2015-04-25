<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {

	protected $fillable = [
		'count',
		'patient_id',
		'user_id'
	];

	public function patient()
	{
		return $this->belongsTo('App\Visit');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
