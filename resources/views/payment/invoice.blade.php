@extends('template.master')
@section('title', 'Payment Invoice')
@section('head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600&display=swap');

        body {
            font-family: 'Maven Pro', sans-serif;
            background-color:rgb(207, 214, 222);
        }

        .hotel-invoice-card {
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .hotel-invoice-header {
            background: linear-gradient(135deg, #1a2a6c, #b21f1f);
            color: white;
            padding: 1.5rem;
        }

        .hotel-logo {
            height: 60px;
            margin-right: 15px;
        }

        .hotel-invoice-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .hotel-invoice-number {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .hotel-divider {
            border-top: 2px dashed rgba(0, 0, 0, 0.1);
            margin: 1rem 0;
        }

        .hotel-section-title {
            color: #1a2a6c;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hotel-content {
            font-size: 0.95rem;
            color: #495057;
        }

        .hotel-highlight {
            font-weight: 600;
            color: #1a2a6c;
        }

        .hotel-table {
            width: 100%;
        }

        .hotel-table td {
            padding: 10px 0;
            vertical-align: top;
        }

        .hotel-amount {
            font-weight: 600;
            color: #28a745;
        }

        .hotel-balance {
            font-weight: 600;
            color: #dc3545;
        }

        .hotel-customer-details {
            background: rgba(26, 42, 108, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-1 {
            margin-bottom: 0.5rem;
        }

        .hotel-service-badge {
            display: inline-block;
            background: rgba(26, 42, 108, 0.1);
            border-radius: 4px;
            padding: 4px 8px;
            margin-right: 6px;
            margin-bottom: 6px;
            font-size: 0.8rem;
        }
    </style>
@endsection
@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card hotel-invoice-card">
                    <div class="hotel-invoice-header d-flex align-items-center">
                        <img src="{{ asset('img/logo/1694675477283 (1).png') }}" class="hotel-logo" alt="Hotel Logo">
                        <div>
                            <div class="hotel-invoice-title">Payment Invoice</div>
                            <div class="hotel-invoice-number">INV-{{ $payment->id }}</div>
                            <small>Issued: {{ Helper::dateFormatTime($payment->created_at) }}</small>
                            <small>Processed by: {{ $payment->user->name }}</small>

                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Stay Period -->
<div class="mb-4">
    <div class="d-flex justify-content-between mb-2">
        <div>
            <div class="hotel-section-title mb-1">Check-In</div>
            <div class="hotel-content hotel-highlight">
                {{ \Carbon\Carbon::parse($payment->transaction->check_in)->format('F d, Y') }}<br>
                <small>{{ \Carbon\Carbon::parse($payment->transaction->check_in)->format('h:i A') }}</small>
            </div>
        </div>
        <div>
            <div class="hotel-section-title mb-1">Check-Out</div>
            <div class="hotel-content hotel-highlight">
                {{ \Carbon\Carbon::parse($payment->transaction->check_out)->format('F d, Y') }}<br>
                <small>{{ \Carbon\Carbon::parse($payment->transaction->check_out)->format('h:i A') }}</small>
            </div>
        </div>
    </div>
    <div class="hotel-divider"></div>
</div>


                        <!-- Room Details -->
                        <div class="mb-4">
                            <div class="hotel-section-title mb-2">Room Charges</div>
                            <table class="hotel-table">
                                <tr>
                                    <td class="hotel-content">Room Type</td>
                                    <td class="hotel-content hotel-highlight">
                                        {{ $payment->transaction->room->type->name }} - Room {{ $payment->transaction->room->number }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hotel-content">Room Services</td>
                                    <td class="hotel-content">
                                        @if($payment->transaction->room->service)
                                            <span class="hotel-service-badge">
                                                {{ $payment->transaction->room->service->name }} (+{{ Helper::convertToPesos($payment->transaction->room->service->price) }})
                                            </span>
                                        @else
                                            No additional services
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hotel-content">Duration</td>
                                    <td class="hotel-content hotel-highlight">
                                        {{ $payment->transaction->getDateDifferenceWithPlural() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hotel-content">Daily Rate</td>
                                    <td class="hotel-content hotel-highlight">
                                        {{ Helper::convertToPesos($payment->transaction->room->price) }}
                                    </td>
                                </tr>
                                @if($payment->transaction->room->service)
                                <tr>
                                    <td class="hotel-content">Service Fee</td>
                                    <td class="hotel-content hotel-highlight">
                                        {{ Helper::convertToPesos($payment->transaction->room->service->price) }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="hotel-content">Total Room Charges</td>
                                    <td class="hotel-content hotel-amount">
                                        {{ Helper::convertToPesos($payment->transaction->getTotalPrice()) }}
                                    </td>
                                </tr>
                            </table>
                            <div class="hotel-divider"></div>
                        </div>

                        @php
    $taxRate = 0.12; // 12%
    $baseTotal = $payment->transaction->getTotalPrice();
    $taxAmount = $baseTotal * $taxRate;
    $grandTotal = $baseTotal + $taxAmount;
@endphp


                        <!-- Payment Summary -->
                        <div class="mb-4">
                            <div class="hotel-section-title mb-2">Payment Summary</div>
                            <table class="hotel-table">
    <tr>
        <td class="hotel-content">Minimum Down Payment</td>
        <td class="hotel-content text-right">
            {{ Helper::convertToPesos($payment->transaction->getMinimumDownPayment()) }}
        </td>
    </tr>
    <tr>
        <td class="hotel-content">Subtotal</td>
        <td class="hotel-content text-right">
            {{ Helper::convertToPesos($baseTotal) }}
        </td>
    </tr>
    <tr>
        <td class="hotel-content">Tax (12%)</td>
        <td class="hotel-content text-right">
            {{ Helper::convertToPesos($taxAmount) }}
        </td>
    </tr>
    <tr>
        <td class="hotel-content font-weight-bold">Grand Total</td>
        <td class="hotel-content hotel-amount text-right font-weight-bold">
            {{ Helper::convertToPesos($grandTotal) }}
        </td>
    </tr>
    <tr>
        <td class="hotel-content">Amount Paid</td>
        <td class="hotel-content hotel-amount text-right">
            {{ Helper::convertToPesos($payment->price) }}
        </td>
    </tr>
    <tr>
        <td class="hotel-content">Remaining Balance</td>
        <td class="hotel-content hotel-balance text-right">
            @php
                $balance = $grandTotal - $payment->transaction->getTotalPayment();
            @endphp
            {{ $balance <= 0 ? '-' : Helper::convertToPesos($balance) }}
        </td>
    </tr>
</table>

                            <div class="hotel-divider"></div>
                        </div>

                        <!-- Customer Details -->
                        <div>
                            <div class="hotel-section-title mb-2">Guest Information</div>
                            <div class="hotel-customer-details">
                                <div class="hotel-content mb-1">
                                    <strong>Guest ID:</strong> {{ $payment->transaction->customer->id }}
                                </div>
                                <div class="hotel-content mb-1">
                                    <strong>Name:</strong> {{ $payment->transaction->customer->name }}
                                </div>
                                <div class="hotel-content mb-1">
                                    <strong>Occupation:</strong> {{ $payment->transaction->customer->job }}
                                </div>
                                <div class="hotel-content">
                                    <strong>Address:</strong> {{ $payment->transaction->customer->address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection