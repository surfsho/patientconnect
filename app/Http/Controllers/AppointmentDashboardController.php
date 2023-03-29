<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AppointmentDashboardController extends Controller
{
    function index() {
        $results = DB::table("appointments")->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('providers', 'appointments.provider_id', '=', 'providers.id')->get();

        return Inertia::render("AppointmentDashboard",[
            "patients"=> $results
        ]);
    }
}
