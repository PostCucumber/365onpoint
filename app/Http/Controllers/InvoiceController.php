<?php

namespace App\Http\Controllers;

use App\Resident;
use Carbon\Carbon;
use App\FacilityInfo;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function select()
    {
        return view('invoices.select');
    }

    public function generate(Request $request, $facility, $year, $month)
    {
        $veteran = $request->veteran;
        $pride = $request->pride;
        $paid = $request->paid;
        $totalAllocation = $request->totalAllocation;
        $contractTerm = $request->contractTerm;
        $totalPaid = $request->totalPaid;
        $balance = $request->balance;
        $expended = $request->expended;
        $allResidents = Resident::where('facility', $facility)->get()->sortBy('last_name');


        $residents = [];
        $facilityInfo = FacilityInfo::where('facility_name', \Auth::user()->facility)->first();
        $manDaysFY = Resident::calculateManDaysForFiscalYear($year, $month);

        $totalBedDaysForMonth = 0;
        $invoiceMonth = Carbon::create($year, $month)->format('F, Y');
        $invoiceNumber = Carbon::create($year, $month)->format('m-Y');
        foreach ($allResidents as $resident) {
            if (Resident::stayedHereDuring($year, $month, $resident)) {
                $totalBedDaysForMonth += Resident::calculateManDaysForMonth($year, $month, $resident);
                $residents[] = $resident;
            }
        }

        return view('invoices.show', compact('residents', 'balance', 'expended', 'totalAllocation', 'contractTerm', 'totalPaid', 'veteran', 'pride', 'paid','totalBedDaysForMonth', 'invoiceNumber', 'invoiceMonth', 'year', 'month', 'facilityInfo', 'manDaysFY'));
    }

    public function printable(Request $request, $facility, $year, $month)
    {
        $allResidents = Resident::where('facility', $facility)->get()->sortBy('last_name');
        setlocale(LC_MONETARY, 'en_US');
        $veteran = $request->veteran;
        $pride = $request->pride;
        $paid = $request->paid;
        $totalAllocation = $request->totalAllocation;
        $contractTerm = $request->contractTerm;
        $totalPaid = $request->totalPaid;
        $balance = $request->balance;
        $expended = $request->expended;

        $residents = [];
        $facilityInfo = FacilityInfo::where('facility_name', \Auth::user()->facility)->first();
        $manDaysFY = Resident::calculateManDaysForFiscalYear($year, $month);
        $monthOfServiceDelivery = strtoupper(Carbon::parse(Carbon::create($year, $month))->format('MY'));
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        $totalBedDaysForMonth = 0;
        $invoiceMonth = Carbon::create($year, $month)->format('F, Y');
        $invoiceNumber = Carbon::create($year, $month)->format('m-Y');
        foreach ($allResidents as $resident) {
            if (Resident::stayedHereDuring($year, $month, $resident)) {
                $residents[] = $resident;
                $totalBedDaysForMonth += Resident::calculateManDaysForMonth($year, $month, $resident);
            }
        }


        return view('invoices.printable', compact('residents', 'balance', 'expended', 'totalAllocation', 'contractTerm', 'totalPaid', 'veteran', 'pride', 'paid', 'daysInMonth', 'totalBedDaysForMonth', 'monthOfServiceDelivery','invoiceNumber', 'invoiceMonth', 'year', 'month', 'facilityInfo', 'manDaysFY'));
    }
}
