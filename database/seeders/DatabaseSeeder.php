<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@capstone.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
            'phone' => '09123456789',
            'barangay' => 'Main Office',
            'is_active' => true,
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@capstone.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '09123456788',
            'barangay' => 'Barangay 1',
            'is_active' => true,
        ]);

        // Create Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'phone' => '09171234567',
            'address' => '123 Main St',
            'barangay' => 'Barangay 1',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'phone' => '09181234567',
            'address' => '456 Oak Ave',
            'barangay' => 'Barangay 2',
            'is_active' => true,
        ]);

        // Create Officials
        \App\Models\Official::create([
            'name' => 'Juan dela Cruz',
            'position' => 'Barangay Captain',
            'contact' => '09123456789',
            'email' => 'captain@barangay.gov',
            'order' => 1,
            'is_active' => true,
        ]);

        \App\Models\Official::create([
            'name' => 'Maria Santos',
            'position' => 'Barangay Councilor',
            'contact' => '09123456788',
            'email' => 'councilor1@barangay.gov',
            'order' => 2,
            'is_active' => true,
        ]);

        // Create Announcements
        \App\Models\Announcement::create([
            'title' => 'Welcome to the Barangay Portal',
            'content' => 'This is the official online portal for our barangay. Here you can file complaints, request documents, and stay updated with announcements.',
            'category' => 'General',
            'is_pinned' => true,
            'is_active' => true,
            'published_at' => now(),
            'created_by' => 1,
        ]);

        \App\Models\Announcement::create([
            'title' => 'Community Clean-up Drive',
            'content' => 'Join us this Saturday for our monthly community clean-up drive. Meeting point at the barangay hall at 6 AM.',
            'category' => 'Events',
            'is_pinned' => false,
            'is_active' => true,
            'published_at' => now(),
            'created_by' => 2,
        ]);
    }
}
