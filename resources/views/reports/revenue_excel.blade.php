<!DOCTYPE html>
<html>
<head>
    <title>Revenue Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Revenue Report</h2>
    <p>Period: {{ $startDate }} to {{ $endDate }}</p>
    <p>Total Revenue: {{ Helper::convertToPesos($totalRevenue) }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Invoice ID</th>
                <th>Guest Name</th>
                <th>Payment Amount</th>
                <th>Date Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>INV-{{ $payment->id }}</td>
                    <td>{{ $payment->transaction->customer->name ?? '-' }}</td>
                    <td>{{ Helper::convertToPesos($payment->price) }}</td>
                    <td>{{ Helper::dateFormatTime($payment->created_at) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
