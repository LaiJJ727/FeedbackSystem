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
        $feedbacks = Feedback::all();
        $branches = Branch::all();

        return view('/report/view', compact('feedbacks', 'branches'));
    }

    public function view2(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        echo $startDate . ' ' . $endDate;
        $feedbacks = Feedback::whereBetween('created_at', [$startDate, $endDate])->get();
        $branches = Branch::all();
        return view('/report/view', compact('feedbacks', 'branches', 'startDate', 'endDate'));
    }
}
