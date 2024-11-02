<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 Drivers each with a Vehicle and 2 assignments
        \App\Models\User::factory(10)->create()->each(function ($user): void {
            $vehicle = \App\Models\Vehicle::factory()->make();
            $assignments = \App\Models\Assignment::factory(2)->make();
            $user->vehicle()->save($vehicle);
            $user->assignments()->saveMany($assignments);
        });

        // Create Admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => 'AdminPassword',
            'role' => UserRole::Admin,
        ]);
    }
}
