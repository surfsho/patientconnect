<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class BookAppointmentController extends Controller
{
    function index() {
        //render inertia template
        return Inertia::render("BookAppointment");
    }

    function create(Request $request) {
        //get collection
        $input = $request->collect();
        $index = 1;
        foreach($input->get('slots') as $value) {
            //insert new appointment
            DB::table("appointments")->insert([
                "appt_date"=> $value['fdate'],
                "appt_time"=> date('Y-m-d H:i:s', strtotime($value['date']." ".$value['time'])),
                "preference" => $index,
                "patient_id" => (int) $input->get('patient'),
                "provider_id" => (int)$input->get('provider')
            ]);

            $index = $index + 1;
        }
        //after creating redirect to appointment dashboard
        return redirect("/appointmentdashboard");
        
    }
}
