<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice, $pdf)
    {
        $this->invoice = $invoice;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Ensure invoice_date and due_date are Carbon instances
        if (!$this->invoice->invoice_date instanceof \Carbon\Carbon) {
            $this->invoice->invoice_date = \Carbon\Carbon::parse($this->invoice->invoice_date);
        }
        if (!$this->invoice->due_date instanceof \Carbon\Carbon) {
            $this->invoice->due_date = \Carbon\Carbon::parse($this->invoice->due_date);
        }

        return $this->view('emails.invoice')
                    ->with(['invoice' => $this->invoice])
                    ->attachData($this->pdf, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ])->subject('Your Invoice')
                    ->to($this->invoice->client->email); ;
    }
}
