<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name' , 'admin')->first();
        $ownerRole = Role::where('name' , 'owner')->first();
        $userRole = Role::where('name' , 'user')->first();

        $admin = User::create([
            'name' => 'Admin User 1',
            'lastname' => 'Admin1',
            'email'=> 'admin1@admin.com',
            'register' => 'АА11111111',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 1',
            'password' => Hash::make('12345678')
        ]);
        $admin1 = User::create([
            'name' => 'Admin User 2',
            'lastname' => 'Admin2',
            'email'=> 'admin2@admin.com',
            'register' => 'АА22222222',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 2',
            'password' => Hash::make('12345678')
        ]);
        $admin2 = User::create([
            'name' => 'Admin User 3',
            'lastname' => 'Admin3',
            'email'=> 'admin3@admin.com',
            'register' => 'АА33333333',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 3',
            'password' => Hash::make('12345678')
        ]);
        $admin3 = User::create([
            'name' => 'Admin User 4',
            'lastname' => 'Admin4',
            'email'=> 'admin4@admin.com',
            'register' => 'АА44444444',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 4',
            'password' => Hash::make('12345678')
        ]);
        $admin4 = User::create([
            'name' => 'Admin User 5',
            'lastname' => 'Admin5',
            'email'=> 'admin5@admin.com',
            'register' => 'АА55555555',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 5',
            'password' => Hash::make('12345678')
        ]);
        $admin5 = User::create([
            'name' => 'Admin User 6',
            'lastname' => 'Admin6',
            'email'=> 'admin6@admin.com',
            'register' => 'АА66666666',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 6',
            'password' => Hash::make('12345678')
        ]);
        $admin6 = User::create([
            'name' => 'Admin User 7',
            'lastname' => 'Admin7',
            'email'=> 'admin7@admin.com',
            'register' => 'АА77777777',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 7',
            'password' => Hash::make('12345678')
        ]);
        $owner = User::create([
            'name' => 'Owner User',
            'lastname' => 'Owner',
            'email'=> 'owner@owner.com',
            'register' => 'ББ12345678',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => 'Салбар 1',
            'password' => Hash::make('12345678')
        ]);
     
        $admin->roles()->attach($adminRole);
        $admin1->roles()->attach($adminRole);
        $admin2->roles()->attach($adminRole);
        $admin3->roles()->attach($adminRole);
        $admin4->roles()->attach($adminRole);
        $admin5->roles()->attach($adminRole);
        $admin6->roles()->attach($adminRole);
        $owner->roles()->attach($ownerRole);
    }
}
