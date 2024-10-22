<?php

namespace App\Http\Controllers;

use App\Models\PeriodClosingModel;
use App\Models\User;
use App\Models\WarehouseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'warehouses' => WarehouseModel::with('staff')->get(),
        ];
        return view('warehouse.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'users' => User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'gudang');
            })->get(),
        ];
        return view('warehouse.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'staff_id' => 'required|exists:users,id',
        ]);
        WarehouseModel::create([
            'name' => $request->name,
            'address' => $request->address,
            'staff_id' => $request->staff_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        return redirect()->route('warehouse.index')->with('success', 'Gudang berhasil ditambahkan');
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
            'warehouse' => WarehouseModel::with('staff')->find($id),
            'users' => User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'gudang');
            })->get(),
        ];
        return view('warehouse.edit', $data);
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
