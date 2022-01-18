<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'department_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'status',
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function department(){
        $this->belongsTo(Department::class);
    }
}
