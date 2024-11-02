<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\POTaxModel;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use App\Helper\CodeGenerator;
use App\Models\PODetailModel;
use App\Models\PeriodClosingModel;
use App\Models\PurchaseOrderModel;
use App\Models\UnitOfMeasureModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = PurchaseOrderModel::with([
                'partner:id,code,name,npwp,address,phone,email,contact_person,is_supplier,is_active',
                'purchaseOrderTaxes:id,amount,tax_id,order_id'
            ])
                ->select('id', 'po_number', 'po_date', 'delivery_date', 'payment_term', 'status', 'total', 'description', 'partner_id')
                ->get()
                ->makeHidden(['created_at', 'updated_at', 'created_by', 'updated_by'])
                ->map(function ($item) {
                    $item->encrypted_id = Crypt::encrypt($item->id);
                    return $item;
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->toJson();
        }



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
        $request->validate([
            'partner_id' => 'required',
            'po_date' => 'required',
            'delivery_date' => 'required',
            'payment_term' => 'required',
        ]);
        $items = json_decode($request->items);

        if (empty($items)) {
            return redirect()->route('po.create')->with('errors', 'Please add item to purchase order');
        }

        $items = $this->reCalculateItems($items);
        $total = array_sum(array_column($items, 'amount'));
        DB::beginTransaction();
        try {
            $po = PurchaseOrderModel::create([
                'po_number' => CodeGenerator::generatePurchaseOrderCode(),
                'po_date' => $request->po_date,
                'delivery_date' => $request->delivery_date,
                'payment_term' => $request->payment_term,
                'partner_id' => $request->partner_id,
                'total' => $total,
                'description' => $request->description,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            foreach ($items as $item) {
                PODetailModel::create([
                    'quantity' => $item->qty,
                    'price' => $item->price,
                    'subtotal' => $item->amount,
                    'discount' => $item->discount,
                    'item_id' => $item->id,
                    'unit_of_measure_id' => $item->uom_id,
                    'purchase_order_header_id' => $po->id,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id()
                ]);
            }
            POTaxModel::create([
                'order_id' => $po->id,
                'amount' => $total * 0.11,
                'tax_id' => 1,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id()
            ]);

            DB::commit();
            return redirect()->route('po.index')->with('success', 'Purchase Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
            return redirect()->route('po.index')->with('errors', "Failed to create Purchase Order, Contact your administrator");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return dd(Crypt::decrypt($id), $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $id = Crypt::decrypt($id);
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first(),
            'partners' => PartnerModel::where('is_supplier', 1)->where('is_active', 1)->get(),
            'items' => ItemModel::where('is_active', 1)->get(),
            'uoms' => UnitOfMeasureModel::where('is_active', 1)->get(),
            'po' => PurchaseOrderModel::with([
                'partner',
                'purchaseOrderDetails',
                'purchaseOrderTaxes'
            ])
                ->select('id', 'po_number', 'po_date', 'delivery_date', 'payment_term', 'status', 'total', 'description', 'partner_id')
                ->find($id)
        ];
        return view('purchase_order.edit', $data);
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
        $po = PurchaseOrderModel::find(Crypt::decrypt($id));
        if ($po->status == 'approved') {
            return redirect()->route('po.index')->with('errors', 'Purchase Order already approved');
        }
        $po->status = 'canceled';
        $po->updated_by = Auth::id();
        $po->save();
        return redirect()->route('po.index')->with('success', 'Purchase Order canceled successfully');
    }

    private function reCalculateItems($items)
    {
        foreach ($items as $item) {
            $item->amount = ($item->qty * $item->price) - $item->discount;
            $item->ppn = $item->amount * 0.11;
        }
        return $items;
    }
}
