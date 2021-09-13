<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(!User::where('email','admin@gmail.com')->exists()){
            DB::table('users')->insert([
                'name' => 'Abdallah  Ashraf',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => true
            ]);
        }

    }
}
