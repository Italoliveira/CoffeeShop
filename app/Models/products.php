<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'category', 'quantity_unit', 'price', 'description','status'];

    public function categories(){
        return $this->belongsTo(categories::class, 'category');
    }
}
