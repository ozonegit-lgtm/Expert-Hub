<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env(
            'ADMIN_EMAIL',
            'admin@example.com'
        );

        $user = User::firstOrNew([
            'email' => $email,
        ]);

        if (! $user->exists) {
            $password = env('ADMIN_PASSWORD');

            if (! is_string($password) || strlen($password) < 12) {
                throw new RuntimeException(
                    'ADMIN_PASSWORD must be set and contain at least 12 characters.'
                );
            }

            $user->password = Hash::make($password);
        }

        $user->name = env(
            'ADMIN_NAME',
            'Administrator'
        );
        $user->is_admin = true;

        if (! $user->email_verified_at) {
            $user->email_verified_at = now();
        }

        $user->save();
    }
}