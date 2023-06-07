<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Feedback;
use App\Models\Branch;
use App\Models\Place;
use App\Models\Title;

class ReportController extends Controller
{
    public function view()
    {
        $feedbackData = Feedback::all();
        return view('/report/view')->with('feedbacks', $feedbackData);
    }

}
