<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->superAdmin();
        $this->internalUsers();
        $this->externalUsers();
    }

    private function superAdmin(): void
    {
        $superAdmin = User::create([
            'first_name' => 'Pranay',
            'last_name' => 'Baddam',
            'email' => 'pranay.baddam@gmail.com',
            'password' => Hash::make('Baddam@£6'),
            'user_type' => UserType::INTERNAL->value,
            'status' => UserStatus::ACTIVE->value
        ]);

        $superAdmin->assignRole(Role::superAdmin()->first()->name);
    }

    private function internalUsers(): void
    {
        User::factory(20)->internal()->active()->create()->each(function (User $user) {
            $user->assignRole(
                Role::whereIn('name', ['Receptionist', 'User'])->pluck('name')->toArray()
            );
        });
    }

    private function externalUsers(): void
    {
        User::factory(50)->external()->create()->each(function (User $user) {
            $user->assignRole(
                Role::whereIn('name', ['Visitor'])->pluck('name')->toArray()
            );
        });
    }
}
