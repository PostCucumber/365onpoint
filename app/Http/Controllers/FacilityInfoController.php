<?php

namespace App\Http\Controllers;

use App\FacilityInfo;
use App\Http\Requests\FacilityInfoRequest;
use App\Transaction;
use Illuminate\Http\Request;

class FacilityInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilityInfo = FacilityInfo::where('facility_name', \Auth::user()->facility)->first();


        if (empty($facilityInfo)) {
            return redirect()->action('FacilityInfoController@create');
        }
        $id = $facilityInfo->id;

        return redirect()->action('FacilityInfoController@edit', compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilityName = \Auth::user()->facility;

        return view('facilityInfo.create', compact('facilityName'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FacilityInfoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityInfoRequest $request)
    {
        FacilityInfo::create([
            'facility_name'       => $request->facility_name,
            'per_diem'            => Transaction::parseCurrency($request->per_diem),
            'contractor_name'     => $request->contractor_name,
            'street_address'      => $request->street_address,
            'fein_number'         => $request->fein_number,
            'max_annual_bed_days' => $request->max_annual_bed_days,
            'contract_number'     => $request->contract_number
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FacilityInfo $facilityInfo
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityInfo $facilityInfo)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FacilityInfo $facilityInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityInfo $facilityInfo)
    {
        return view('facilityInfo.edit', compact('facilityInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FacilityInfoRequest|Request $request
     * @param  \App\FacilityInfo $facilityInfo
     * @return \Illuminate\Http\Response
     */
    public function update(FacilityInfoRequest $request, FacilityInfo $facilityInfo)
    {
        $facilityInfo->update([
            'facility_name'       => $request->facility_name,
            'per_diem'            => Transaction::parseCurrency($request->per_diem),
            'contractor_name'     => $request->contractor_name,
            'street_address'      => $request->street_address,
            'fein_number'         => $request->fein_number,
            'max_annual_bed_days' => $request->max_annual_bed_days,
            'contract_number'     => $request->contract_number
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FacilityInfo $facilityInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityInfo $facilityInfo)
    {
        //
    }
}
