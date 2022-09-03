<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use Illuminate\Database\Seeder;
use App\Models\CommunityCategory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'password' =>  Hash::make('adminpas'),
            'group' => 'superadmin'
        ]);
        User::create([
            'name' => 'admin-ob-arwana',
            'password' =>  Hash::make('adminpas'),
            'group' => 'admin-ob'
        ]);
        User::create([
            'name' => 'admin-hr',
            'password' =>  Hash::make('adminpas'),
            'group' => 'admin-hr'
        ]);
        User::create([
            'name' => 'admin-safety',
            'password' =>  Hash::make('adminpas'),
            'group' => 'admin-safety'
        ]);
    }
}
