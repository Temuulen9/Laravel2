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

        $ownerRole = Role::where('name' , 'owner')->get()->first();


        
        $owner = User::create([
            'name' => 'Owner User',
            'lastname' => 'Owner',
            'email'=> 'owner@owner.com',
            'register' => 'ББ12345678',
            'lesson_type' => 'Шинэ жолоочийн сургалт',
            'branch' => '',
            'password' => Hash::make('12345678'),
            'role' => $ownerRole->name,
            'role_id' =>$ownerRole->id,
        ]);
     
    }
}
