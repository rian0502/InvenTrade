<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //

    public function index()
    {

        $data = [
            'categories' => CategoryModel::all(),
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('category.index', $data);
    }

    public function create()
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('category.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|min:3',
            'description' => 'required|min:10',
        ]);
        CategoryModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => 1,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'category' => CategoryModel::find($id)
        ];
        return view('category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10',
        ]);
        CategoryModel::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'updated_by' => Auth::id(),
        ]);
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        return $id;
    }
}
