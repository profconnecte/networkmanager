<?php

namespace App\Http\Controllers;

use App\Services\BindApiService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Instanciate BindRestApi Service
        $bindRestApi = new BindApiService();

        // Use the getAllZoneRecords method to get all zone records
        $records = $bindRestApi->getAllZoneRecords();

        // Count the number of records with specific rrtype
        $nbIp = 0;
        $nbCname = 0;
        $nbPTR = 0;
        foreach ($records as $record) {
            if ($record->rrtype == 'A') {
                $nbIp++;
            }
            if ($record->rrtype == 'CNAME') {
                $nbCname++;
            }
            if ($record->rrtype == 'PTR') {
                $nbPTR++;
            }
        }

        return view('dashboard', ['nb_ip' => $nbIp, 'nbCname' => $nbCname, 'nbPTR' => $nbPTR]);
    }
}
