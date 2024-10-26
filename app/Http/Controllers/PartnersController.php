<?php

namespace App\Http\Controllers;

use App\Models\PartnerModel;
use Illuminate\Http\Request;
use App\Helper\CodeGenerator;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'partners' => PartnerModel::all(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('partners.index', $data);
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
        return view('partners.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'contact_person' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);
        //generate code
        $code = CodeGenerator::generatePartnerCode($request->is_supplier);

        PartnerModel::create([
            'code' => $code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_person' => $request->contact_person,
            'address' => $request->address,
            'description' => $request->description,
            'is_supplier' => $request->is_supplier,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('partner.index')->with('success', 'Partner created successfully');
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
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'partner' => PartnerModel::find($id)
        ];
        return view('partners.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'contact_person' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);
        PartnerModel::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact_person' => $request->contact_person,
            'address' => $request->address,
            'description' => $request->description,
            'is_supplier' => $request->is_supplier,
            'is_active' => $request->is_active,
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('partner.index')->with('success', 'Partner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return dd($id);
    }
}
