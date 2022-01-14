<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPicture extends Model
{
    // use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'picture_id',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function picture(){
        $this->belongsTo(Picture::class);
    }
}
