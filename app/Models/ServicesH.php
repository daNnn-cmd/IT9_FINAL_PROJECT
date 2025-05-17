<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesH extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    protected $table = 'services_h';

    // app/Models/ServicesH.php
public function rooms()
{
    return $this->hasMany(Room::class);
}
}