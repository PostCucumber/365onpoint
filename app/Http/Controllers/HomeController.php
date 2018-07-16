<?php

namespace App\Http\Controllers;

use App\Resident;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $intakes        = array();
        $releases       = array();
        $manDays        = array();
        $currentManDays = Resident::calculateManDaysForCurrentMonth();

        for ($i = 0; $i < 6; $i++) {

            $intakes[ $i ]['month']  = Carbon::now()->subMonths(($i + 1))->format('M, Y');
            $intakes[ $i ]['count']  =
                DB::table('residents')
                    ->where('facility', \Auth::user()->facility)
                    ->whereMonth('date_of_admission', Carbon::now()->subMonths(($i + 1))->month)
                    ->whereYear('date_of_admission', Carbon::now()->subMonths(($i + 1))->year)
                    ->count();
            $releases[ $i ]['month'] = Carbon::now()->subMonths(($i + 1))->format('M, Y');
            $releases[ $i ]['count'] =
                DB::table('residents')
                    ->where('facility', \Auth::user()->facility)
                    ->whereMonth('actual_date_of_discharge', Carbon::now()->subMonths(($i + 1))->month)
                    ->whereYear('actual_date_of_discharge', Carbon::now()->subMonths(($i + 1))->year)
                    ->count();

            $manDays[ $i ]['month'] = Carbon::now()->subMonths(($i + 1))->format('M, Y');
            $manDays[ $i ]['count'] = Resident::calculateManDaysForMonth(
                Carbon::now()->subMonths($i + 1)->year,
                Carbon::now()->subMonths($i + 1)->month
            );

        }


        return view('home', compact('intakes', 'releases', 'currentManDays', 'manDays'));
    }
}
