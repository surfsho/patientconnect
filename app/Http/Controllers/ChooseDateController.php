<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ChooseDateController extends Controller
{
    function index() {
        return Inertia::render("ChooseDate");
    }
}
