<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilityReportsController extends Controller
{
    public function select()
    {
        return view('reports.facilities.select');
    }

    public function router(Request $request)
    {
        $facility = $request->facility;
        $report   = $request->report;
        $date     = $request->date;

        switch ($report) {
            case 'intakes':
                $intakes = $this->intakesReport($facility, $date);
                $count   = $intakes->count();
                return view('reports.facilities.intakesIndex', compact('intakes', 'count', 'date'));
                break;
            case 'releases':
                $releases = $this->releasesReport($facility, $date);
                $count    = $releases->count();

                return view('reports.facilities.releasesIndex', compact('releases', 'count', 'date'));
                break;
        }
    }

    private function intakesReport($facility, $date)
    {
        if ($date == 'year_to_date') {
            $intakes = DB::table('residents')
                ->select(DB::raw('*'))
                ->where('facility', $facility)
                ->whereYear('date_of_admission', Carbon::now('America/Chicago')->year)
                ->get();

            return $intakes;
        }
        $date  = Carbon::parse($date);
        $month = $date->month;
        $year  = $date->year;

        $intakes = DB::table('residents')
            ->select(DB::raw('*'))
            ->where('facility', $facility)
            ->whereMonth('date_of_admission', $month)
            ->whereYear('date_of_admission', $year)
            ->get();


        return $intakes;
    }

    private function releasesReport($facility, $date)
    {
        if ($date == 'year_to_date') {
            $releases = DB::table('residents')
                ->select(DB::raw('*'))
                ->where('facility', $facility)
                ->whereYear('actual_date_of_discharge', Carbon::now('America/Chicago')->year)
                ->get();

            return $releases;
        }
        $date  = Carbon::parse($date);
        $month = $date->month;
        $year  = $date->year;

        $releases = DB::table('residents')
            ->select(DB::raw('*'))
            ->where('facility', $facility)
            ->whereMonth('actual_date_of_discharge', $month)
            ->whereYear('actual_date_of_discharge', $year)
            ->get();


        return $releases;
    }
}
