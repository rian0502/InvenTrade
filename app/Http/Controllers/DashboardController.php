<?php

namespace App\Http\Controllers;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('dashboard.index', $data);
    }
}
