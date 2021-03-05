<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'phone_number',
        'location'
    ];

    public function hasUsers()
    {
        return $this->hasMany('App\Models\User');
    }
}
