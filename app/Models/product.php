<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'nutritional_value',
        'farmer_id',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

}
