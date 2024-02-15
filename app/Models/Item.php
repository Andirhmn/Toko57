<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use HasFactory;

    protected $fillable = [
	    'nama', 'category_id', 'harga_satuan', 'status'];

    public function category()
    {
	return $this->belongsTo(Category::class, 'category_id');
    }
}
