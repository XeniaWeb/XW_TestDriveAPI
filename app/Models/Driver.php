<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'nickname',
        'email',
        'phone',
        'age',
        'is_free',
    ];

    public function carDrivings():HasMany
    {
        return $this->hasMany(CarDriving::class);
    }
}
