<?php

namespace Database\Seeders;

use App\Models\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    public function run()
    {
        InvoiceItem::create([
            'invoice_id' => 1, // Assuming the invoice with ID 1 exists
            'device_id' => 1, // Assuming the device with ID 1 exists
            'service' => 'security router',
            'unit_cost' => 10.00,
            'total_cost' => 100.00,
            'number_of_days' => 10,
        ]);

        InvoiceItem::create([
            'invoice_id' => 1, // Assuming the invoice with ID 1 exists
            'device_id' => 2, // Assuming the device with ID 2 exists
            'service' => 'server',
            'unit_cost' => 25.00,
            'total_cost' => 250.00,
            'number_of_days' => 10,
        ]);
    }
}
