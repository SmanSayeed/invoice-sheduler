<!DOCTYPE html>
<html>
<head>
    <title>Invoice Reminder</title>
</head>
<body>
    <h1>Invoice Reminder</h1>
    <p>Dear {{ $invoice->client->name }},</p>

    <p>This is a reminder that invoice #{{ $invoice->invoice_number }} is overdue for payment.</p>

    <p>Please find attached the invoice details.</p>

    <p>Thank you for your prompt attention to this matter.</p>

    <p>Regards,</p>
    <p>Your Service Provider</p>
</body>
</html>
