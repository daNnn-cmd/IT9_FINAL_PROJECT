<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'room_status_id',
        'service_id', 
        'number',
        'capacity',
        'price',
        'view',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function roomStatus()
    {
        return $this->belongsTo(RoomStatus::class, 'room_status_id');
    }

    public function service()
    {
        return $this->belongsTo(ServicesH::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function firstImage()
    {
        if ($this->image->count() > 0) {
            return $this->image->first()->getRoomImage();
        }

        return asset('img/default/9688970f95e0f3e3b39aebe4533c03816427c27c.jpeg');
    }
// In App\Models\Room
public function transactions()
{
    return $this->hasMany(Transaction::class);
}
    public function status()
{
    return $this->belongsTo(RoomStatus::class, 'room_status_id');
}

}