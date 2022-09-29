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
            'employee_uuid' => '0',
            'uuid' => '0',
            'nik_employee' => 'superadmin',
            'password' =>  Hash::make('password'),
            'role' => 'superadmin'
        ]
    );
    User::create(
    [
        'employee_uuid' => 'employee-admin-hr-uuid',
        'uuid' => 'admin-hr-uuid',
        'nik_employee' => 'admin-hr',
        'password' =>  Hash::make('password'),
        'role' => 'admin-hr'
    ]
    );
    User::create(
        [
            'employee_uuid' => 'employee-logistic-uuid',
            'uuid' => 'logistic-uuid',
            'nik_employee' => 'logistic',
            'password' =>  Hash::make('password'),
            'role' => 'logistic'
        ]
        );
    }
}
