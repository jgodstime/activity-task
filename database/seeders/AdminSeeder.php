<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = UserRoleEnum::GetEnumsKeyByName('SUPER ADMIN');
        $user = User::where('email', 'admin@gmail.com')->where('role', $role)->first();

        if (! $user) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => $role,
            ]);
        }
    }
}
