<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentReportsController extends Controller
{
    /**
     * ResidentReportsController constructor.
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function select()
    {
        return view('reports.residents.select');
    }
}
