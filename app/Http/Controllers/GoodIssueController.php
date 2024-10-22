<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodIssueController extends Controller
{
    //

    public function index()
    {
        return view('good_issue.index');
    }
}
