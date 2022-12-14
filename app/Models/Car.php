<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand',
        'model',
        'age_year',
        'is_free',
    ];

    public function carDrivings():HasMany
    {
        return $this->hasMany(CarDriving::class);
    }
}
