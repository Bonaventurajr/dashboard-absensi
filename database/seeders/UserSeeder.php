<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama (optional - hati-hati!)
        // User::truncate();
        
        // Buat beberapa user
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'phone' => '081234567890',
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'is_active' => true,
                'phone' => '081234567891',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_active' => true,
                'phone' => '081234567892',
            ],
            [
                'name' => 'Mones',
                'email' => 'mones@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
                'phone' => '081234567893',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::where('email', $userData['email'])->first();
            if (!$user) {
                User::create($userData);
                $this->command->info("User {$userData['email']} created.");
            } else {
                $this->command->info("User {$userData['email']} already exists.");
            }
        }

        $this->command->info('====================================');
        $this->command->info('USERS CREATED/VERIFIED:');
        $this->command->info('admin@example.com / password');
        $this->command->info('manager@example.com / password');
        $this->command->info('user@example.com / password');
        $this->command->info('mones@gmail.com / password123');
        $this->command->info('====================================');
    }
}