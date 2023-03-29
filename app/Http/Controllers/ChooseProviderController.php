<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChooseProviderController extends Controller
{
    function index() {
        //get all providers
        $providers = DB::table('providers')->get();
        //serve vuejs template
        return Inertia::render("ChooseProvider", ['providers' => $providers]);
    }

    function create(Request $request) {
        //get collection
        $input = $request->collect();
        //get uploaded avatar
        $uploaded_files = $request->file('avatar')->store('public/uploads/');
        //create provider
        DB::table('providers')->insert(['full_name'=>$input->get('fullname'),'qualification'=>$input->get('qualification'),'avatar'=>asset($uploaded_files),'address'=>""]);
        
    }
}
