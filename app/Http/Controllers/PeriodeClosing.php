<?php

namespace App\Http\Controllers;

use App\Models\PeriodClosingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeClosing extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'periods' => PeriodClosingModel::all(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('closing_periode.index', $data);
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
        return view('closing_periode.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'start_date' => 'required|date|before:end_date|different:end_date',
            'end_date' => 'required|date|after:start_date|different:start_date',
        ]);
        DB::beginTransaction();
        try {
            PeriodClosingModel::where('is_closed', 0)->update(['is_closed' => 1]);
            PeriodClosingModel::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_closed' => 0,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('period.index')->with('error', 'Periode Closing Was Failed To Create');
        }
        return redirect()->route('period.index')->with('success', 'Periode Closing Was Created Successfully');
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
