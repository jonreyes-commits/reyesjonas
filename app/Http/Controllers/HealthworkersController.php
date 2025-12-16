<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthworkersController extends Controller
{
    public function HealthworkersDashboard()
    {
        return view('Healthworkersdashboard.healthworkers');
    }
}
