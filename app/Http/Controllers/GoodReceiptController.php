<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;

class GoodReceiptController extends Controller
{
    //

    public function index()
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('good_receipt.index', $data);
    }
}
