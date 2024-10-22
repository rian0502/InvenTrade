<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Models\UnitOfMeasureModel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UoMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'uoms' => UnitOfMeasureModel::all(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('uom.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('uom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        UnitOfMeasureModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('uom.index')->with('success', 'Unit of Measure created successfully');
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
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'uom' => UnitOfMeasureModel::find($id)
        ];
        return view('uom.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return dd($request->all()); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
