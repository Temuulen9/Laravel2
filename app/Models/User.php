<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class  User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'register',
        'email',
        'lesson_type',
        'branch',
        'password',
        'branch_id',
        'role',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function hasRole()
    {
        return $this->belongsTo('App\Models\Role', 'id');
    }   
    
    public function hasBranch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function hasResults()
    {
        return $this->hasMany('App\Models\Result');
    }

    public static function search($searchname, $searchlastname, $searchreg, $searchtype)
    {
        return empty($searchname) && empty($searchlastname) && empty($searchreg) && empty($searchtype) ? static::query()
            : static::query()->where('lastname', 'like', '%'.$searchname.'%')
                ->Where('name', 'like', '%'.$searchlastname.'%')
                ->Where('register', 'like', '%'.$searchreg.'%')
                ->Where('lesson_type', 'like', '%'.$searchtype.'%');
    }

    public static function search_with_branch($branch_name ,$searchname, $searchlastname, $searchreg, $searchtype)
    {
        return empty($searchname) && empty($searchlastname) && empty($searchreg) && empty($searchtype) ? static::query()->where('branch', 'like', '%'.$branch_name.'%')
            : static::query()->where('branch', 'like', '%'.$branch_name.'%')
                ->where('lastname', 'like', '%'.$searchname.'%')
                ->Where('name', 'like', '%'.$searchlastname.'%')
                ->Where('register', 'like', '%'.$searchreg.'%')
                ->Where('lesson_type', 'like', '%'.$searchtype.'%');
    }

}
