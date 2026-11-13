<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Lola Valeroso',
            'email'    => 'lola.valeroso@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadUser = User::create([
            'name'     => 'Kagawad Franz Lorenz Valeroso',
            'email'    => 'kagawad.valeroso@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        // link the login account to the existing Kagawad author profile
        Author::where('email', 'kagawad.valeroso@bulletin.test')
            ->update(['user_id' => $kagawadUser->id]);

        User::factory()->count(8)->create();
    }
}
