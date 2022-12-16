<?php

namespace App\Http\Controllers\Frontend\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HRController extends Controller
{
    //

    public function index()
    {
        return view('frontend.HR.index');
    }
}
