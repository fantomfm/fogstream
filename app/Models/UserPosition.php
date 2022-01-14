<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    // use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'position_id',
        'status',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function position(){
        $this->belongsTo(Position::class);
    }
}
