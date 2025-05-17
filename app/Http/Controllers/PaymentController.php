<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Helpers\Helper;
use App\Repositories\Interface\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository
    ) {
    }

    public function index(Request $request)
{
    $payments = Payment::with(['transaction.room', 'user'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10); 
    
    return view('payment.index', compact('payments'));
}

    public function create(Transaction $transaction)
    {
        return view('transaction.payment.create', [
            'transaction' => $transaction,
        ]);
    }

    public function store(Transaction $transaction, Request $request)
    {
        $insufficient = $transaction->getTotalPrice() - $transaction->getTotalPayment();
        $request->validate([
            'payment' => 'required|numeric|lte:'.$insufficient,
        ]);

        $this->paymentRepository->store($request, $transaction, 'Payment');

        return redirect()->route('transaction.index')->with('success', 'Transaction room '.$transaction->room->number.' success, '.Helper::convertToPesos($request->payment).' paid');
    }

    public function invoice(Payment $payment)
    {
        return view('payment.invoice', [
            'payment' => $payment,
        ]);
    }
}
