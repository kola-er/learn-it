<?php

namespace Learn;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
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
	protected $table = 'profiles';

	protected $fillable = ['user_id', 'first_name', 'last_name', 'avatar'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user() {
		return $this->belongsTo('\Learn\User');
	}
}
