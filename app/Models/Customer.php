<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'Customers';
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
