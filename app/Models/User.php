<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;

    // public $timestamps = false;
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
        return $this->belongsToMany(Picture::class)->orderByDesc('updated_at')->limit(1);
    }
}
