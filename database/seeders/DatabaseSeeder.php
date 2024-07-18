<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User
        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $customer = Role::create(['name' => 'Customer']);

        $user1->assignRole($role);
        $user2->assignRole($customer);
    }
}