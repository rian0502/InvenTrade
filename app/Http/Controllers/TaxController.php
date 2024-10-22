<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;
use App\Models\TaxModel;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    //
    public function index()
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'taxes' => TaxModel::all()
        ];
        return view('tax.index', $data);
    }

    public function create()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('tax.create', $data);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'rate' => 'required|numeric',
        ]);
        TaxModel::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('tax.index')->with('success', 'Tax created successfully');
    }

    public function edit($id)
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'tax' => TaxModel::find($id),
        ];
        return view('tax.edit', $data);
    }
    public function update(Request $request, $id)
    {
        //
        return dd($request->all());
        $request->validate([
            'name' => 'required',
            'rate' => 'required',
            'description' => 'required',
        ]);

        return redirect()->route('tax.index')->with('success', 'Tax updated successfully');
    }
}
