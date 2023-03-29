<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class BookAppointmentController extends Controller
{
    function index() {
        return Inertia::render("BookAppointment");
    }

    function create(Request $request) {
        $input = $request->collect();
        foreach($input->get('slots') as $value) {
            DB::table("appointments")->insert([
                "givendate"=> $value['fdate'],
                "giventime"=> date('Y-m-d H:i:s', strtotime($value['date']." ".$value['time'])),
                "patient_id" => (int) $input->get('patient'),
                "provider_id" => (int)$input->get('provider')
            ]);
        }
        return redirect("/appointmentdashboard");
        
    }
}
