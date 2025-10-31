<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'master@fahd.my.id'],
            [
                'name' => 'Fahd',
                'password' => Hash::make('masterfahd'),
            ]
        );
    }
}
