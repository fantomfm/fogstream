<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionUser extends Model
{
    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'position_user';

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
