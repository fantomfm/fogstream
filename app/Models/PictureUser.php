<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PictureUser extends Model
{
    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'picture_user';

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
