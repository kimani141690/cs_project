<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $table = 'farmers';
    protected $fillable = [
        'id',
        'contact',
        'location',
        'address',
        'profile',
    ];
