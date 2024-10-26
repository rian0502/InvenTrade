<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;
use App\Models\UnitOfMeasureModel;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('purchase_order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'partners' => PartnerModel::where('is_supplier', 1)->where('is_active', 1)->get(),
            'items' => ItemModel::where('is_active', 1)->get(),
            'uoms' => UnitOfMeasureModel::where('is_active', 1)->get(),
        ];

        return view('purchase_order.create', $data);    
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        return dd($request->all());
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
