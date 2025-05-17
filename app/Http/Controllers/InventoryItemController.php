<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItemModel;
use App\Models\PeriodClosingModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class InventoryItemController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InventoryItemModel::with('item')
            ->select('id', 'item_id', 'stock', 'price')
            ->get()
            ->makeHidden(['created_at', 'updated_at', 'created_by', 'updated_by'])
            ->map(function ($item) {
                $item->encrypted_id = Crypt::encrypt($item->id);
                return $item;
            });
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('item', function ($item) {
                    return $item->item->code . ' - ' . $item->item->name;
                })
                ->editColumn('uom', function ($item) {
                    return $item->item->uom->name;
                })
                ->toJson();
        }
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('inventory_item.index', $data);
    }
}
