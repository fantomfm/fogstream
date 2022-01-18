<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TablesSeeder extends Seeder
{
    static $roles = [
        'Администратор',
        'Пользователь',
        'Менеджер',
    ];
    
    static $positions = [
        'Без должности',
        'Руководитель',
        'Программист',
        'Инженер',
    ];

    static $departments = [
        'Без отдела',
        'Отдел 1',
        'Отдел 2',
        'Отдел 3',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$roles as $role) {
            DB::table('roles')->insert([
                'role' => $role,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        foreach (self::$positions as $position) {
            DB::table('positions')->insert([
                'position' => $position,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        foreach (self::$departments as $department) {
            DB::table('departments')->insert([
                'department' => $department,
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Администратор',
            'user' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('department_user')->insert([
            'department_id' => 1,
            'user_id' => 1,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('position_user')->insert([
            'position_id' => 1,
            'user_id' => 1,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
