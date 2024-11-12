<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Cities extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'city'];

    public function region()
    {
        return $this->belongsTo(Regions::class, 'region_id');
    }

    public function rates()
    {
        return $this->hasMany(Rates::class, 'city_id'); // Correct the foreign key
    }
}
