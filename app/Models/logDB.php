<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logDB extends Model
{
	//  use HasFactory;
    protected $table = 'logs';
    protected $primaryKey = 'id';
    protected $fillable = [
	    'user_id',
	    'extra'];

    public static function record($user_id, $extra)
    {
    	return static::create([
		'user_id' => is_null($user_id) ? null : $user_id->username,
		'extra' => $extra]);
    }
}
