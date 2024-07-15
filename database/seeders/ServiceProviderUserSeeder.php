<?php

namespace Database\Seeders;

use App\Models\ServiceProviderUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServiceProviderUserSeeder extends Seeder
{
    public function run()
    {
        ServiceProviderUser::create([
            'company_name' => 'Tech Solutions',
            'address' => '456 Tech Park, Tech City, USA',
            'logo' => 'path/to/logo.png',
            'vat_number' => 'VAT123456',
            'kvk_number' => 'KVK789101',
            'email' => 'admin@techsolutions.com',
            'password' => Hash::make('password'),
        ]);
    }
}
