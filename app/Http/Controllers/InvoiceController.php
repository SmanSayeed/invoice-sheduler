<?php

namespace App\Http\Controllers;

use App\Jobs\SendInvoiceEmail;
use App\Mail\InvoiceMail;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class InvoiceController extends Controller
{
    public function invoiceDetails($invoiceId){
        $invoice = Invoice::with('client', 'items')->findOrFail($invoiceId);
        return response()->json($invoice);
    }
    public function generate(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'gbs_information' => 'nullable|string',
            'footnote' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            $client = Client::findOrFail($request->client_id);
            $devices = $client->devices;
            $totalCost = 0;

            // Calculate total cost and prepare invoice items
            $invoiceItems = [];
            foreach ($devices as $device) {
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $days = $end->diffInDays($start);

                $unitCost = $device->unit_cost;
                $totalCost += $unitCost * $days;

                // Prepare invoice item data
                $invoiceItems[] = [
                    'device_id' => $device->id,
                    'service' => $device->class,
                    'unit_cost' => $unitCost,
                    'number_of_days' => $days,
                    'total_cost' => $unitCost * $days,
                ];
            }

            // Create a new invoice instance without saving it yet
            $invoice = new Invoice([
                'client_id' => $client->id,
                'service_provider_user_id' => 1, // Replace with actual authenticated user ID
                'invoice_number' => 'INV-' . time(),
                'invoice_date' => now(),
                'due_date' => now()->addDays(30),
                'status' => 'pending',
                'unit_cost' => $unitCost,
                'number_of_days' => $days,
                'total_cost' => $totalCost,
                'footnote' => $request->footnote,
                'gbs_information' => $request->gbs_information,
            ]);

            // Save the invoice to get the invoice ID
            $invoice->save();

            // Associate invoice items with the invoice
            foreach ($invoiceItems as $item) {
                $item['invoice_id'] = $invoice->id;
                InvoiceItem::create($item);
            }

            // Commit the transaction
            DB::commit();

            return response()->json($invoice->load('items'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function sendInvoice($id)
    {
        $invoice = Invoice::with('client', 'items')->findOrFail($id);
        $invoice->load('items.device');

        // Generate PDF
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'))->output();

        // Dispatch the job to send the invoice email
        Mail::send(new InvoiceMail($invoice, $pdf));

        return response()->json(['message' => 'Invoice sent successfully']);
    }
}
