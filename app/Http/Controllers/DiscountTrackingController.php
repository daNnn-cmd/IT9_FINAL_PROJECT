<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DiscountTrackingController extends Controller
{
    public function index()
    {
        // Get all past transactions with customer and room
        $transactions = Transaction::with('customer', 'room')
            ->where('check_out', '<', now())
            ->get();

        // Only keep transactions that are fully paid
        $fullyPaidTransactions = $transactions->filter(function ($transaction) {
            return ($transaction->getTotalPrice() - $transaction->getTotalPayment()) <= 0;
        });

        // Group by customer and count reservations
        $grouped = $fullyPaidTransactions->groupBy('customer_id')->map(function ($group) {
            return [
                'customer' => $group->first()->customer,
                'reservation_count' => $group->count(),
            ];
        });

        // Only customers with 3 or more reservations
        $eligibleCustomers = $grouped->filter(function ($data) {
            return $data['reservation_count'] >= 3;
        });

        return view('discount_tracking.index', [
            'customers' => $eligibleCustomers
        ]);
    }
}
