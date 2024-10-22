<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Models\UnitOfMeasureModel;
use App\Models\UnitConversionModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitConversionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'conversions' => UnitConversionModel::all()
        ];
        return view('Uom_Conversion.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'uoms' => UnitOfMeasureModel::where('is_active', 1)->get(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('Uom_Conversion.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'from_unit_id' => 'required|different:to_unit_id',
            'to_unit_id' => 'required|different:from_unit_id',
            'conversion_value' => 'required',
            'conversion_name' => 'required',
        ]);
        UnitConversionModel::create([
            'from_unit_id' => $request->from_unit_id,
            'to_unit_id' => $request->to_unit_id,
            'conversion_value' => $request->conversion_value,
            'conversion_name' => $request->conversion_name,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        return redirect()->route('conversion.index')->with('success', 'Conversion created successfully');
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

        $data = [
            'conversion' => UnitConversionModel::find($id),
            'uoms' =>  UnitOfMeasureModel::where('is_active', 1)->get(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('Uom_Conversion.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'from_unit_id' => 'required|different:to_unit_id',
            'to_unit_id' => 'required|different:from_unit_id',
            'conversion_value' => 'required',
            'conversion_name' => 'required',
        ]);
        $conversion = UnitConversionModel::find($id);
        $conversion->from_unit_id = $request->from_unit_id;
        $conversion->to_unit_id = $request->to_unit_id;
        $conversion->conversion_value = $request->conversion_value;
        $conversion->conversion_name = $request->conversion_name;
        $conversion->updated_by = Auth::id();
        $conversion->save();
        return redirect()->route('conversion.index')->with('success', 'Conversion updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
