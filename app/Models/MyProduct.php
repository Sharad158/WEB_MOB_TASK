<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyProduct extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = ['name','price'];
    // protected $guarded = [];
}
