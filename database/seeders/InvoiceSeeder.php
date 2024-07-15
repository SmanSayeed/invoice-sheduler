<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        Invoice::create([
            'client_id' => 1, // Assuming the client with ID 1 exists
            'service_provider_id' => 1, // Assuming the service provider user with ID 1 exists
            'invoice_number' => 'INV-2024-07-15-001',
            'invoice_date' => now(),
            'due_date' => now()->addDays(30),
            'amount' => 350.00,
            'status' => 'pending',
        ]);
    }
}
