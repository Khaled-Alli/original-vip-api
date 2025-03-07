<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Laptop extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'name',
        'brand',
        'processor',
        'processorGeneration',
        'ram',
        'viga',
        'hard',
        'isTouch',
        'camera',
        'keyboardBacklight',
        'additionalHard',
        'price',
        'quantity',
        'visibility',
        'inAED',
        'image',
    ];
}
