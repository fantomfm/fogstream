<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function positionUser(){
        return $this->hasMany(PositionUser::class)->where('status', 1);
    }

    public function departmentUser(){
        return $this->hasMany(DepartmentUser::class)->where('status', 1);
    }

    public function PictureUser(){
        return $this->hasMany(PictureUser::class);
    }

    public function positions(){
        return $this->belongsToMany(Position::class)->where('status', 1);
    }

    public function departments(){
        return $this->belongsToMany(Department::class)->where('status', 1);
    }

    public function pictures(){
        return $this->belongsToMany(Picture::class)->withTimestamps();
    }

    public function getLastPicture(){
        if ($this->pictures())
            return $this->pictures()->orderByDesc('updated_at')->limit(1);
    }

    public function getDateRegistration() {
        return $this->created_at->format('d.m.Y');
    }
}
