<?php

namespace App\Http\Controllers;

use App\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function select()
    {
        $residents = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('last_name');

        return view('reports.transactions.select', compact('residents', 'types'));
    }

    public function runReport(Request $request)
    {
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $resident_id = $request->resident_id;
        $start_date  = isset($request->start_date) ? Carbon::parse($request->start_date)->toDateString() : null;
        $end_date    = isset($request->end_date) ? Carbon::parse($request->end_date)->toDateString() : null;
        $reasons     = $request->reason;

        if ($resident_id == null) {
            $residents = Resident::with(['transactions' => function ($query) use ($start_date, $end_date, $reasons) {
                $query->when($start_date, function ($query) use ($start_date) {
                    return $query->where('date', '>=', $start_date);
                });
                $query->when($end_date, function ($query) use ($end_date) {
                    return $query->where('date', '<=', $end_date);
                });
                $query->when($reasons, function ($query) use ($reasons) {
                    return $query->whereIn('reason', $reasons);
                });
            }])->where('facility', auth()->user()->facility)->get()->sortBy('last_name');

            return view('reports.transactions.transactionIndexRunningTotal', compact('residents'));
        }

        $transactions = DB::table('transactions')
            ->join('residents', 'residents.id', '=', 'transactions.resident_id')
            ->where('residents.facility', '=', \Auth::user()->facility)
            ->when($resident_id, function ($query) use ($resident_id) {
                return $query->where('resident_id', $resident_id);
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->where('date', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->where('date', '<=', $end_date);
            })
            ->when($reasons, function ($query) use ($reasons) {
                return $query->whereIn('reason', $reasons);
            })
            ->get();

        $credits = $transactions->pluck('credit')->sum();
        $debits  = $transactions->pluck('debit')->sum();
        $balance = money_format('%.2n', ($credits - $debits) / 100);

        $class = ($credits - $debits > 0) ? 'credit' : 'debit';

        return view('reports.transactions.transactionIndex', compact('transactions', 'balance', 'class'));
    }
}
