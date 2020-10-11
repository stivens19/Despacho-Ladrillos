<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id'=>1,
            'name' => 'Stivens Espinoza',
            'dni'=>'73041310',
            'email'=>'stivens70espinoza@gmail.com',
            'password'=>
            Hash::make('12345678')
            
        ]);
    }
}
