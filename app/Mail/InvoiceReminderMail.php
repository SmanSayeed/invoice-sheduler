<?php

namespace App\Mail;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @param Invoice $invoice
     * @param mixed $pdf
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
        return $this->view('emails.invoice-reminder')
                    ->subject('Reminder: Invoice Payment Due')
                    ->with(['invoice' => $this->invoice])
                    ->attachData($this->pdf, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
