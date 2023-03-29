<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AppointmentDashboardController extends Controller
{
    function index() {
        //get appointments by joining two tables
        $results = DB::table("appointments")->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('providers', 'appointments.provider_id', '=', 'providers.id')->orderBy('patient_id','DESC')->get();
        
        $provider_names = DB::table("providers")->pluck('full_name');
        //send data to vuejs template
        return Inertia::render("AppointmentDashboard",[
            "patients"=> $results,
            "providers"=>$provider_names
        ]);
    }
}
