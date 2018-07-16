<?php

namespace App\Http\Controllers;

use App\Resident;
use App\Transaction;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function lastName()
    {
        $sortType     = 'last name';
        $downloadLink = '/report/download/last_name';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('last_name');

        return view('reports.residentIndex', compact('residents', 'sortType', 'downloadLink'));
    }


    public function download($sortBy)
    {
        Excel::create('Keeton Residents' . Carbon::now()->toDateString(), function ($excel) use ($sortBy) {

            $excel->sheet('Resident Report', function ($sheet) use ($sortBy) {

                $residents = Resident::where('facility', \Auth::user()->facility)->get()->sortBy($sortBy);

                $sheet->loadView('reports.residentIndexXLS', compact('residents'));
            });
        })->download('xls');
    }

    public function stream($sortBy)
    {
        Excel::create('Keeton Residents' . Carbon::now()->toDateString(), function ($excel) use ($sortBy) {

            $excel->sheet('Resident Report', function ($sheet) use ($sortBy) {

                $residents = Resident::where('facility', \Auth::user()->facility)->get()->sortBy($sortBy);

                $sheet->loadView('reports.residentIndexXLS', compact('residents'));
            });
        })->export('pdf');
    }

    public function streamDOB()
    {
        $sortType     = 'date of birth';
        $downloadLink = '/report/download/dob';
        $pdfLink      = '/report/stream/dob';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('dob');

        $pdf = PDF::loadView('reports.residentIndex', [$downloadLink, $residents, $pdfLink, $sortType]);
        return $pdf->stream();
    }

    public function dob()
    {
        $sortType     = 'date of birth';
        $downloadLink = '/report/download/dob';
        $pdfLink      = '/report/stream/dob';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('dob');

        return view('reports.residentIndex', compact('residents', 'sortType', 'downloadLink', 'pdfLink'));
    }

    public function admitDate()
    {
        $sortType     = 'date of admission';
        $downloadLink = '/report/download/date_of_admission';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('date_of_admission');

        return view('reports.residentIndex', compact('residents', 'sortType', 'downloadLink'));
    }

    public function releaseDate()
    {
        $sortType     = 'projected date of discharge';
        $downloadLink = '/report/download/projected_date_of_discharge';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('actual_date_of_discharge');

        return view('reports.residentIndex', compact('residents', 'sortType', 'downloadLink'));
    }
    public function counselor()
    {
        $sortType     = 'counselor';
        $downloadLink = '/report/download/counselor';
        $residents    = Resident::where('facility', \Auth::user()->facility)->get()->sortBy('counselor');

        return view('reports.residentIndex', compact('residents', 'sortType', 'downloadLink'));
    }

    public function transactionIndex()
    {
        $transactions = Transaction::where('facility', \Auth::user()->facility)->get()->sortBy('date');

        return view('reports.transactionIndex', compact('transactions'));
    }
}
