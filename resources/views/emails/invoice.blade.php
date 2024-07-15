<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Email</title>
</head>
<body>
    <p>Dear {{ $invoice->client->name }},</p>
    <p>Please find attached your invoice for the services provided.</p>
    <p>Invoice Number: {{ $invoice->invoice_number }}</p>
    <p>Invoice Date: {{ $invoice->invoice_date->format('Y-m-d') }}</p>
    <p>Due Date: {{ $invoice->due_date->format('Y-m-d') }}</p>
    <p>Total Cost: ${{ number_format($invoice->total_cost, 2) }}</p>

    @if ($invoice->gbs_information)
    <p>GBS Information: {{ $invoice->gbs_information }}</p>
    @endif

    @if ($invoice->footnote)
    <p>Footnote: {{ $invoice->footnote }}</p>
    @endif

    <p>Thank you for your business.</p>
</body>
</html>
