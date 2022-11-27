<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Admin2seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'admin2@admin.com',
            'password' => Hash::make('admin'),
            'name' => 'admin2'
        ]);

        $admin = User::create([
            'email' => 'admin3@admin.com',
            'password' => Hash::make('admin'),
            'name' => 'admin3'
        ]);
    }
}
