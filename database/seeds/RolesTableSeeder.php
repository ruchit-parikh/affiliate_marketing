<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('roles') as $role_slug => $role) {
            Role::updateOrCreate([
                'slug' => $role_slug,
            ], [
                'name' => $role['name']
            ]);
        }
    }
}
