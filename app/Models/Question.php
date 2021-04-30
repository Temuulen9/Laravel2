<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'sub',
        'question',
        'image',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'answer'
    ];

    public static function search($searchtype, $searchsub, $searchques)
    {
        return empty($searchtype) && empty($searchsub) && empty($searchques) ? static::query()
            : static::query()->where('type', 'like', '%'.$searchtype.'%')
                ->where('sub', 'like', '%'.$searchsub.'%')
                ->where('question', 'like', '%'.$searchques.'%');
    }
}
