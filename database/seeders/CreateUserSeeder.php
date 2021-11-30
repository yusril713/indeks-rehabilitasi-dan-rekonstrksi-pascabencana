<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = "admin@admin.com";
        $user->name = "Administrator";
        $user->password = Hash::make('admin');
        $user->save();
        $user->assignRole('Super Admin');
    }
}
