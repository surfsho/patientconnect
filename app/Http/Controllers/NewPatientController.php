<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NewPatientController extends Controller
{
    function index() {
        return Inertia::render("NewPatient");
    }

    function create(Request $request) {
        $input = $request->collect();
        DB::table('patients')->insert($request->validate([
            'first_name' => ["required"],
            "last_name" => ["required"],
            "gender" => ["required"],
            "email_address" => ["required"],
            "phone_number" => ["required"],
            "dateofbirth" => ["required"],
            "zipcode" => ["required"],
            "state" => ["required"]
        ]));
        return redirect("/chooseprovider?patient=".DB::getPdo()->lastInsertId());
    }
}
