<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'user_type'=>'admin',
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
            'active'=>1,
        ]);
        User::create([
            'name'=>'Arun.Kannan',
            'email'=>'arun.kannan@atplgroups.com',
            'user_type'=>'admin',
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
            'active'=>1,
        ]);
        User::create([
            'name'=>'A.Kumar',
            'email'=>'KumarA@iprings.com',
            'user_type'=>'normal',
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
            'active'=>1,
        ]);
        User::create([
            'name'=>'B.Kumar',
            'email'=>'KumarB@iprings.com',
            'user_type'=>'normal',
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
            'active'=>1,
        ]);
    }
}
