<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use Illuminate\Routing\Controller;
use PhpParser\Node\Stmt\Return_;

class PosNewSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
        ];
        return view('pos_sale.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
