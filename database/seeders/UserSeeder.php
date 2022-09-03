<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $users = [
            [
                'uuid' => 'ini-uuid-user-seeder-1',
                'name' => 'Ahmadi',
                'email' => 'madi@digipark.go.id',
                'password' =>  Hash::make('secret'),
                'phone_number' => '0812341234',
                'photo_path' => 'Gamteng.jpg',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
