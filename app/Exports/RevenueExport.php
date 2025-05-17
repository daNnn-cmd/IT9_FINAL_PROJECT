<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;

class RevenueExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $startDate = $this->request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $this->request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalRevenue = $payments->sum('price');

        return view('reports.revenue_excel', compact('payments', 'totalRevenue', 'startDate', 'endDate'));
    }
}
