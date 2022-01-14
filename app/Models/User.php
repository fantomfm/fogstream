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

    public function getRole(){
        return $this->role->role;
    }

    public function userPositions(){
        return $this->hasMany(UserPosition::class);
    }

    public function userDepartments(){
        return $this->hasMany(UserDepartment::class);
    }

    public function userPictures(){
        return $this->hasMany(UserPicture::class);
    }
}
