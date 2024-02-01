<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
        User::query()->truncate();
        $admin = User::create([
            'name' => 'Ketua Koperasi',
            'username' => 'ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('123123'),
            'level' => 99,
        ]);

        $admin->assignRole('ketua');
    }
}
