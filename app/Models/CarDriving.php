<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarDriving extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'driver_id',
        'car_id',
        'start_drive',
        'finish_drive',
    ];

    public function car(): belongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function driver(): belongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
