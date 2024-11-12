<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rates extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'rate'];

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }
}

