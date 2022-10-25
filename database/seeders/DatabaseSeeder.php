<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::updateOrCreate(['name' => config('app.ROLE_ADMIN')]);
        $role_socio = Role::updateOrCreate(['name' => config('app.ROLE_SOCIO')]);

        $user = User::updateOrCreate([
            'name' => config('app.EMAIL_ADMIN'),
            'email' => config('app.EMAIL_ADMIN'),
            'password' => Hash::make(config('app.PASSWORD_ADMIN'))
        ]);

        $user->syncRoles($role);
    }
}
