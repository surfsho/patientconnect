<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use MailchimpTransactional\ApiClient;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class AppointmentDashboardController extends Controller
{
    function index() {
        //get appointments by joining two tables
        $results = DB::table("appointments")->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('providers', 'appointments.provider_id', '=', 'providers.id')->orderBy('patient_id','DESC')->get();
        
        $provider_names = DB::table("providers")->pluck('full_name');

        $message = DB::table('message')->get();
        //send data to vuejs template
        return Inertia::render("AppointmentDashboard",[
            "patients"=> $results,
            "providers"=>$provider_names,
            "messages"=> $message
        ]);
    }

    function sendEmail(Request $request) {
        
        Mail::to($request->input('email'))->send(new TestEmail($request->input('message')));
    }

    function createTemplate() {
        return Inertia::render("CreateTemplate");
    }

    function newTemplate(Request $request) {
        DB::table('message')->insert([
            "name" => $request->input('name'),
            "template" => $request->input('template'),
            "type" => $request->input('type')
        ]);
    }
}
