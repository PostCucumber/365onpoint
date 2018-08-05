<?php

namespace App\Http\Controllers;

use App\Resident;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SoftDeletesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residents = DB::table('residents')->where('facility', \Auth::user()->facility)->where('soft_deleted_at', true)->orderBy('last_name')->get();

        return view('residents.soft-deleted', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $now = Carbon::now()->toDateTimeString();
        $resident = Resident::find($id);
        $resident->update([
            'soft_deleted_at' => null,
            'restored_at' => $now
        ]);

        return back();
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->toDateTimeString();
        $resident = Resident::find($id);
        $resident->update([
            'soft_deleted_at' => $now,
            'restored_at' => null
        ]);

        return back();
    }
}
