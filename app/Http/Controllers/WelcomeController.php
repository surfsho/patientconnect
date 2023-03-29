<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    function index() {
        //serve vuejs template
        return Inertia::render("Hello");
    }
}
