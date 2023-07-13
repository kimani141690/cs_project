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
        'email',
        'username',
        'password',
        'remember_me',
        'account_status',
        'email_verified_at',
        'google_id',
        'location',
        'contact',
        'address',
        'profile',
    ];
}
