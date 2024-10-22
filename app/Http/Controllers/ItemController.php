<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use App\Helper\CodeGenerator;
use App\Models\CategoryModel;
use App\Models\PeriodClosingModel;
use App\Models\UnitOfMeasureModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //

    public function index()
    {
        $data = [
            'items' => ItemModel::with('category', 'uom')->get(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('item.index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => CategoryModel::where('is_active', true)->get(),
            'uoms' => UnitOfMeasureModel::where('is_active', true)->get(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('item.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'uom_id' => 'required',
        ]);

        ItemModel::create([
            'code' => CodeGenerator::generateItemCode(),
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'uom_id' => $request->uom_id,
            'is_active' => true,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('item.index')->with('success', 'Item created successfully');
    }

    public function edit($id)
    {
        $data = [
            'categories' => CategoryModel::where('is_active', true)->get(),
            'uoms' => UnitOfMeasureModel::where('is_active', true)->get(),
            'item' => ItemModel::find($id),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('item.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'uom_id' => 'required',
        ]);
        ItemModel::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'uom_id' => $request->uom_id,
            'updated_by' => Auth::id()
        ]);
        return redirect()->route('item.index')->with('success', 'Item updated successfully');
    }
    public function destroy($id)
    {
        return redirect()->route('item.index');
    }

}
