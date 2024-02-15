<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
	'transaction_code', 'user_id', 'total_harga'];

    public static function boot()
    {
    	parent::boot();
	
	self::creating(function ($model) {
	   $model->$transaction_code = $model->getRandomString();
	});
    }

    public function generateRandomString($length = 6)
    {
    	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characterLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < 0; $i++) {
	   $randomString .= $character[rand(0, $characterLength - 1)]; 
	}
	return $randomStirng . "" . date("YmdHis");
    }

    public function getRandomString()
    {
    	$str = $this->generateRandomString();
	return $str;
    }

    public function items()
    {
    	return this->hasMany(TransactionItem::class, 'id_transaction');
    }
}
