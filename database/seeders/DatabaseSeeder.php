<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            ServiceProviderUserSeeder::class,
            DeviceSeeder::class,
            // InvoiceSeeder::class,
            // InvoiceItemSeeder::class,
        ]);
    }
}
