<?php

namespace Learn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to timestamps.
	 *
	 * @var  array
	 */
	public $timestamps = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'videos';

	public function user() {
		return $this->belongsTo('\Learn\User');
	}

	public function category() {
		return $this->belongsTo('\Learn\Category');
	}
}
