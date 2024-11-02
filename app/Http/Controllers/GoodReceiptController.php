<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\PartnerModel;
use Illuminate\Http\Request;
use App\Models\PeriodClosingModel;
use App\Models\PurchaseOrderModel;
use App\Models\UnitOfMeasureModel;
use App\Models\UnitConversionModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoodReceiptStore;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


class GoodReceiptController extends Controller
{
    //

    public function index()
    {
        $data = [
            'period' => PeriodClosingModel::where('is_closed', 0)->first()
        ];
        return view('good_receipt.index', $data);
    }

    public function create($id)
    {
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
        return view('good_receipt.create', $data);
    }

    public function store(GoodReceiptStore $request)
    {
        $po = PurchaseOrderModel::with('purchaseOrderDetails.item')->where('po_number', $request->po_number)->first();
        if (!$po) {
            return response()->json(['error' => 'Purchase order not found'], 404);
        }
        $errors = [];
        foreach ($po->purchaseOrderDetails as $key => $pod) {
            $receivedQty = $request->received_qty[$key] ?? null;
            $uom = $request->uom[$key] ?? null;
            if ($receivedQty > $pod->quantity) {
                $errors['received_qty.' . $key] = ['Received quantity cannot be greater than quantity ordered for item ' . $pod->item->name];
            }
            if ($receivedQty <= 0) {
                $errors['received_qty.' . $key] = ['Received quantity must be greater than 0 for item ' . $pod->item->name];
            }
            if ($uom != $pod->item->uom_id) {
                $conversionExists = UnitConversionModel::where('from_unit_id', $uom)
                    ->orWhere('to_unit_id', $uom)
                    ->exists();
                if (!$conversionExists) {
                    $errors['uom.' . $key] = ['Unit of measure for item ' . $pod->item->name . ' is not valid, and No conversion exists'];
                }
            }
        }
        if (!empty($errors)) {
            return response()->json(['errors' => $errors], 422);
        }

        return response()->json(['message' => 'Store Good Receipt']);
    }
}
