@extends('template.master')
@section('title', 'Revenue Report')
@section('head')
    <style>
        body {
            background-color: rgb(223, 229, 237);
            font-family: 'Maven Pro', sans-serif;
        }
        .report-card {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            background: #fff;
            padding: 2rem;
            margin-top: 2rem;
        }
        .report-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1a2a6c;
        }
        .report-summary {
            font-size: 1.2rem;
            font-weight: 600;
            color: #28a745;
        }
        .table th, .table td {
            vertical-align: middle;
        }

        .hotel-invoice-btn {
    background: #f4f6fa;
    color: #1a2a6c;
    border: 1px solid #ccc;
    padding: 5px 10px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease;
}
.hotel-invoice-btn:hover {
    background-color: #1a2a6c;
    color: #fff;
}
.hotel-invoice-btn {
    text-decoration: none;
}

    </style>
@endsection
@section('content')

<div class="container py-0.8">
    <div class="report-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="report-title">Revenue Report</h1>

            <div class="mb-3">
    <a href="{{ route('reports.revenue.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-danger me-2">
        Export PDF
    </a>
    <a href="{{ route('reports.revenue.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">
        Export Excel
    </a>
</div>

            <form method="GET" action="{{ route('reports.revenue') }}" class="d-flex">
                <input type="date" name="start_date" class="form-control me-2" value="{{ $startDate }}">
                <input type="date" name="end_date" class="form-control me-2" value="{{ $endDate }}">
                <button class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="mb-4">
            <h4 class="report-summary">Total Revenue: {{ Helper::convertToPesos($totalRevenue) }}</h4>
        </div>

        <div class="table-responsive">
    <table class="table table-striped">
        <thead class="bg-light-blue text-white">
            <tr>
                <th>#</th>
                <th>Invoice ID</th>
                <th>Guest Name</th>
                <th>Payment Amount</th>
                <th>Payment Date</th>
                <th>Payment Time</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>INV-{{ $payment->id }}</td>
                    <td>{{ $payment->transaction->customer->name ?? '-' }}</td>
                    <td>{{ Helper::convertToPesos($payment->price) }}</td>
                    <td>{{ $payment->created_at->format('F d, Y') }}</td>
                    <td>{{ $payment->created_at->format('h:i A') }}</td>

                    <td>
                        <a href="{{ route('payment.invoice', $payment->id) }}" class="hotel-invoice-btn">
                            <i class="fas fa-file-invoice me-1"></i> Invoice
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


        


    </div>
</div>

@endsection
