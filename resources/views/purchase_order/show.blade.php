@extends('layouts.index')

@section('title')
    Detail Purchase Order
@endsection

@section('content')
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8">
                {{-- Header --}}
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('po.index') }}" class="btn btn-danger"><span class="left badge"><i
                                    class="fas fa-arrow-left"></i></span> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="partner_id" class="form-label">Vendor</label>
                                    <select id="partner_id" disabled
                                        class="form-control select2bs4 @error('partner_id') is-invalid @enderror"
                                        style="width: 100%;" name="partner_id">
                                        @foreach ($partners as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('partner_id', $po->partner_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('partner_id')
                                        <span id="partner_id" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="po_date" class="form-label">Purchase Order Date</label>
                                    <input type="date" class="form-control @error('po_date') is-invalid @enderror"
                                        id="po_date" readonly aria-describedby="po_date" name="po_date"
                                        value="{{ old('po_date', $po->po_date) }}">
                                    @error('po_date')
                                        <span id="po_date" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="delivery_date" class="form-label">Delivery Date</label>
                                    <input readonly type="date" class="form-control @error('delivery_date') is-invalid @enderror"
                                        id="delivery_date" aria-describedby="delivery_date" name="delivery_date"
                                        value="{{ old('delivery_date', $po->delivery_date) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_term" class="form-label">Payment Term</label>
                                    <select disabled id="payment_term"
                                        class="form-control select2bs4 @error('payment_term') is-invalid @enderror"
                                        style="width: 100%;" name="payment_term">
                                        <option value="CBD"
                                            {{ old('payment_term', $po->payment_term) == 'CBD' ? 'selected' : '' }}>
                                            Cash Before Delivery</option>
                                        <option value="CAD"
                                            {{ old('payment_term', $po->payment_term) == 'CAD' ? 'selected' : '' }}>
                                            Cash After Delivery</option>
                                        <option value="COD"
                                            {{ old('payment_term', $po->payment_term) == 'COD' ? 'selected' : '' }}>
                                            Cash On Delivery</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea disabled aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                                        id="description" rows="3" name="description">{{ old('description', $po->description) }}</textarea>
                                    @error('description')
                                        <span id="description" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Header --}}

                {{-- Detail --}}
                {{-- Product --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="productTable">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Measure</th>
                                    <th>Diskon</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($po->purchaseOrderDetails as $item)
                                    <tr>
                                        <td>{{ $item->item->code . ' - ' . $item->item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->unitOfMeasure->name }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" id="itemList" name="items">
                    </div>
                    
                </div>
                {{-- End Product --}}
            </div>
            <div class="col-md">
                {{-- Preiview --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Preview</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <strong>Total Price</strong>
                            </div>
                            <div class="col-6 text-right">
                                <span id="totalPrice">{{ old(0, $po->total) }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <strong>PPN (11%)</strong>
                            </div>
                            <div class="col-6 text-right">
                                <span id="vatAmount">{{ old(0, $po->purchaseOrderTaxes[0]->amount) }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <strong>Discount</strong>
                            </div>
                            <div class="col-6 text-right">
                                <span id="discountAmount">{{ old(0, 0) }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <strong>Total Amount</strong>
                            </div>
                            <div class="col-6 text-right">
                                <span
                                    id="totalPurchaseAmount">{{ old(0, $po->total + $po->purchaseOrderTaxes->first()->amount) }}</span>
                            </div>
                        </div>
                        <hr>
                        
                    </div>
                </div>
                {{-- End Preview --}}
            </div>
        </div>
    </div>

    {{-- Start Dropdown Item --}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="item_id" class="form-label">Item</label>
                                <select id="item_id" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                            {{ $item->code . ' - ' . $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty" aria-describedby="qty"
                                    value="1" min="1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="item_price" aria-describedby="price"
                                    value="1" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="uom_id" class="form-label">Measure</label>
                                <select id="uom_id" class="form-control select2bs4" style="width: 100%;">
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}">
                                            {{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="diskon" class="form-label">Diskon</label>
                                <input type="text" class="form-control" id="diskon" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="subtotal" class="form-label">Subtotal</label>
                                <input type="text" class="form-control text-right" id="subtotal" value="1"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="saveItemBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- End Dropdown Item --}}



    <script src="/plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let items = [];
            var podetail = @json($po->purchaseOrderDetails);

            podetail.forEach(function(item) {
                items.push({
                    id: item.id,
                    qty: item.quantity,
                    price: item.price,
                    discount: item.discount,
                    uom_id: item.unit_of_measure.id,
                    amount: item.subtotal
                });
            });



            // Update subtotal when quantity, price, or discount changes
            $('#qty, #item_price, #diskon').on('input', function() {
                updateSubtotal();
            });

            // Update subtotal, total price, VAT, and total amount
            function updateSubtotal() {
                var qty = parseFloat($('#qty').val()) || 0;
                var price = parseFloat($('#item_price').val()) || 0;
                var discount = parseFloat($('#diskon').val()) || 0;
                var subtotal = qty * price - discount;
                $('#subtotal').val(subtotal.toFixed(2));

                updateTotals();
            }

            // Save item to list and update totals
            $('#saveItemBtn').on('click', function() {
                var itemId = $('#item_id').val();
                var itemText = $('#item_id option:selected').text();
                var qty = parseFloat($('#qty').val());
                var price = parseFloat($('#item_price').val());
                var discount = parseFloat($('#diskon').val());
                var subtotal = parseFloat($('#subtotal').val());
                var itemId = $('#item_id').val();
                var itemText = $('#item_id option:selected').text();
                var qty = parseFloat($('#qty').val());
                var price = parseFloat($('#item_price').val());
                var discount = parseFloat($('#diskon').val());
                var subtotal = parseFloat($('#subtotal').val());
                var item = {
                    id: $('#item_id').val(),
                    qty: parseFloat($('#qty').val()) || 0,
                    price: parseFloat($('#item_price').val()) || 0,
                    discount: parseFloat($('#diskon').val()) || 0,
                    uom_id: $('#uom_id').val()
                };
                item.amount = (item.qty * item.price) - item.discount;

                items.push(item);
                var newRow = `<tr>
                    <td>${itemText}</td>
                    <td>${qty}</td>
                    <td>${price.toFixed(2)}</td>
                    <td>${$('#uom_id option:selected').text()}</td>
                    <td>${discount.toFixed(2)}</td>
                    <td>${subtotal.toFixed(2)}</td>
                </tr>`;
                $('#productTable tbody').append(newRow);
                $('#itemList').val(JSON.stringify(items));
                updateTotals();
                $('#modal-lg').modal('hide');
                $('#qty').val(1);
                $('#item_price').val(1);
                $('#diskon').val(0);
                $('#subtotal').val(0);
            });

            // Calculate and display total price, VAT, and total amount
            function updateTotals() {
                var totalPrice = items.reduce((sum, item) => sum + item.amount, 0);
                var vatAmount = totalPrice * 0.11; // 11% VAT
                var totalAmount = totalPrice + vatAmount;

                $('#totalPrice').text(totalPrice.toFixed(2));
                $('#vatAmount').text(vatAmount.toFixed(2));
                $('#totalPurchaseAmount').text(totalAmount.toFixed(2));
            }


        });
    </script>
@endsection
