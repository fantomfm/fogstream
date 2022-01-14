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
            ]);
        }

        foreach (self::$positions as $position) {
            DB::table('positions')->insert([
                'position' => $position,
            ]);
        }

        foreach (self::$departments as $department) {
            DB::table('departments')->insert([
                'department' => $department,
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Администратор',
            'user' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);
    }
}
