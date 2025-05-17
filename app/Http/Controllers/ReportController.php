<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RevenueExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    // View the Revenue Report
    // View the Revenue Report
    public function revenueReport(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalRevenue = $payments->sum('price');

        return view('reports.revenue_report', compact('payments', 'totalRevenue', 'startDate', 'endDate'));
    }

    // Export Revenue Report to PDF
    public function exportPDF(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? Carbon::now()->endOfMonth()->toDateString();

        $payments = Payment::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalRevenue = $payments->sum('price');

        $pdf = PDF::loadView('reports.revenue_pdf', compact('payments', 'totalRevenue', 'startDate', 'endDate'));
        return $pdf->download('revenue_report.pdf');
    }

    // Export Revenue Report to Excel
    public function exportExcel(Request $request)
    {
        return Excel::download(new RevenueExport($request), 'revenue_report.xlsx');
    }

    public function revenueIndex()
{
    // Get the current year
    $currentYear = Carbon::now()->year;

    // Fetch monthly revenue
    $monthlyRevenue = Payment::whereYear('created_at', $currentYear)
        ->selectRaw('MONTH(created_at) as month, SUM(price) as revenue')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Prepare data for the chart
    $months = [];
    $revenues = [];
    for ($i = 1; $i <= 12; $i++) {
        $month = $monthlyRevenue->firstWhere('month', $i);
        $months[] = Carbon::create()->month($i)->format('F');  // Month names (e.g. January)
        $revenues[] = $month ? $month->revenue : 0;  // Set 0 for months without revenue
    }

    // Calculate additional statistics
    $totalRevenue = Payment::whereYear('created_at', $currentYear)->sum('price');
    $completedReservations = Payment::whereYear('created_at', $currentYear)
        ->where('status', 'completed')
        ->count();
    $outstandingBalance = Payment::whereYear('created_at', $currentYear)
        ->where('status', 'pending')
        ->sum('price');

    return view('reports.revenue_index', compact('months', 'revenues', 'totalRevenue', 'completedReservations', 'outstandingBalance'));
}
}
