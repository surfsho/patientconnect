<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChooseProviderController extends Controller
{
    function index() {
        $providers = DB::table('providers')->get();
        return Inertia::render("ChooseProvider", ['providers' => $providers]);
    }

    function create(Request $request) {
        $input = $request->collect();
        $uploaded_files = $request->file('avatar')->store('public/uploads/');
        DB::table('providers')->insert(['full_name'=>$input->get('fullname'),'qualification'=>$input->get('qualification'),'avatar'=>asset($uploaded_files),'address'=>""]);
        return $uploaded_files;
    }
}
