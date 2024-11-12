<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helmet extends Model
{
    use HasFactory;
    protected $fillable = [
        "category",
        "style",
        "brand",
        "name",
        "details",
        "price",
        "quantity",
        "image"
    ];
}
