<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 100%;
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details, .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details td, .invoice-items th, .invoice-items td {
            border: 1px solid #000;
            padding: 8px;
        }
        .invoice-items th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
        </div>
        <table class="invoice-details">
            <tr>
                <td><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</td>
                <td><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</td>
            </tr>
            <tr>
                <td><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</td>
                <td><strong>Due Date:</strong> {{ $invoice->due_date }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Total Cost:</strong> ${{ number_format($invoice->total_cost, 2) }}</td>
            </tr>
            @if ($invoice->gbs_information)
            <tr>
                <td colspan="2"><strong>GBS Information:</strong> {{ $invoice->gbs_information }}</td>
            </tr>
            @endif
            @if ($invoice->footnote)
            <tr>
                <td colspan="2"><strong>Footnote:</strong> {{ $invoice->footnote }}</td>
            </tr>
            @endif
        </table>
        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Device</th>
                    <th>Service</th>
                    <th>Unit Cost</th>
                    <th>Number of Days</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->device->name }}</td>
                    <td>{{ $item->service }}</td>
                    <td>${{ number_format($item->unit_cost, 2) }}</td>
                    <td>{{ $item->number_of_days }}</td>
                    <td>${{ number_format($item->total_cost, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
