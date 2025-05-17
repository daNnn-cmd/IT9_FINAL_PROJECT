<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\Interface\TransactionRepositoryInterface;
use Carbon\Carbon; 
class TransactionController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index(Request $request)
    {
        $transactions = $this->transactionRepository->getTransaction($request);
        $transactionsExpired = $this->transactionRepository->getTransactionExpired($request);
        

        return view('transaction.index', [
            'transactions' => $transactions,
            'transactionsExpired' => $transactionsExpired,
        ]);
    }

    
    public function past()
    {
        $transactions = Transaction::with(['customer', 'room'])
            ->where('check_out', '<', now()) // Assuming "past" means checked out
            ->orderBy('check_out', 'desc')
            ->paginate(10);

        return view('transaction.past_reservation', compact('transactions'));
    }

    public function p()
{
    $transactionsExpired = Transaction::with(['customer', 'room'])
        ->where('check_out', '<', now())
        ->orderBy('check_out', 'desc')
        ->paginate(10);

    return view('transaction.p', compact('transactionsExpired'));
}

public function showExtendForm(Transaction $transaction)
{
    $transaction->check_out = Carbon::parse($transaction->check_out);
    return view('transaction.extend', compact('transaction'));
}


public function processExtend(Request $request, Transaction $transaction)
{
    $request->validate([
        'new_checkout' => 'required|date|after:' . $transaction->check_out,
    ]);

    $transaction->check_out = $request->new_checkout;
    $transaction->save();

    return redirect()->route('transaction.index')->with('success', 'Stay extended successfully.');
}

public function showEarlyCheckoutForm(Transaction $transaction)
{
    $transaction->check_out = Carbon::parse($transaction->check_out);
    return view('transaction.early_checkout', compact('transaction'));
}

public function processEarlyCheckout(Request $request, Transaction $transaction)
{
    $request->validate([
        'new_checkout' => 'required|date|before:' . $transaction->check_out,
    ]);

    $transaction->check_out = $request->new_checkout;
    $transaction->status = 'checked_out';
    $transaction->save();

    $transaction->room->room_status_id = 1; // Vacant
    $transaction->room->save();

    return redirect()->route('transaction.index')->with('success', 'Early checkout updated and room marked as vacant.');
}


public function discountDashboard()
{
    
    $customers = Transaction::with('customer')
        ->selectRaw('customer_id, COUNT(*) as reservation_count')
        ->whereRaw('check_out < NOW()')  
        ->whereRaw('(total_price - total_payment) <= 0') 
        ->groupBy('customer_id')
        ->having('reservation_count', '>=', 3) 
        ->get();

    return view('discount.index', compact('customers'));
}

public function checkOut(Transaction $transaction)
{
    $transaction->status = 'checked_out';
    $transaction->save();

    $transaction->room->room_status_id = 1; // Vacant
    $transaction->room->save();

    return redirect()->route('transaction.index')->with('success', 'Checkout successful. Room is now vacant.');
}
}