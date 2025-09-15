<?php

namespace Database\Seeders;

use App\Models\Lender;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lender = User::updateOrCreate(
            ['email' => 'lender@gmail.com'],
            [
                'name' => 'Lender Satu',
                'password' => Hash::make('lender'),
                'role' => 'lender',
            ]
        );

        Lender::updateOrCreate([
            'user_id'      => $lender->id,
            'company_name' => 'Bank ABCD',
            'balance'      => 100000000
        ]);

        $lender2 = User::updateOrCreate(
            ['email' => 'lender2@gmail.com'],
            [
                'name' => 'Lender Dua',
                'password' => Hash::make('lender2'),
                'role' => 'lender',
            ]
        );

        Lender::updateOrCreate([
            'user_id'      => $lender2->id,
            'company_name' => 'Bank EFGH',
            'balance'      => 200000000
        ]);
    }
}
