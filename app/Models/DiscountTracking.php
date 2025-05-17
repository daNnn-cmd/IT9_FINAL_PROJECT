<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTracking extends Model
{
    use HasFactory;

    protected $fillable = ['discount_percentage', 'valid_from', 'valid_to'];
}

