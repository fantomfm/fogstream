<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department',
    ];

    public function departmentUser(){
        $this->hasMany(DepartmentUser::class);
    }
}
