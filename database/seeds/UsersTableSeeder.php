<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('default_users') as $role => $user) {
            $user = User::updateOrCreate([
                'username' => $user['username'], 
                'email' => $user['email'], 
            ], [
                'name' => $user['name'],
                'password' => $user['password'],
                'pay_id' => $user['pay_id'] ?? '', 
                'pay_type' => $user['pay_type'] ?? '',
                'status' => User::$status[$user['status']]['code'], 
                'role_id' => Role::where('slug', $role)->firstOrFail()->id
            ]);
        }
    }
}
