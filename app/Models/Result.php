<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'point',
        'start_time',
        'end_time'
    ];

    public function hasUser()
    {
        return $this->belongsTo('App\Models\User');
    }
}
