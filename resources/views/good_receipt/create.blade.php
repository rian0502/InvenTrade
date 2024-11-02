@extends('layouts.index')
@section('title')
    Create Good Receipt
@endsection

@section('content')
    <div class="col">
        <form id="goodReceiptForm" method="POST">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_number" class="form-label">Purchase Order Code</label>
                                <input type="text" readonly class="form-control" id="po_number" name="po_number"
                                    value="{{ $po->po_number }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_term" class="form-label">Payment Term</label>
                                <input type="text" disabled class="form-control" id="payment_term" name="payment_term"
                                    value="{{ $po->payment_term }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="partner_id" class="form-label">Vendor</label>
                                <select id="partner_id" disabled class="form-control select2bs4" name="partner_id" style="width: 100%;">
                                    @foreach ($partners as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $po->partner_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po_date" class="form-label">Purchase Order Date</label>
                                <input disabled type="date" class="form-control" id="po_date" name="po_date"
                                    value="{{ $po->po_date }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transaction_date" class="form-label">Good Receipt Date</label>
                                <input type="date" class="form-control @error('transaction_date') is-invalid @enderror"
                                    id="transaction_date" name="transaction_date" value="{{ old('transaction_date') }}">
                                @error('transaction_date')
                                    <span id="transaction_date" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" value="{{ old('description') }}">
                                @error('description')
                                    <span id="description" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty PO</th>
                                <th>Qty Received</th>
                                <th>Measure</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($po->purchaseOrderDetails as $item)
                                <tr>
                                    <td>{{ $item->item->code . ' - ' . $item->item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <input type="number" name="received_qty[{{ $item->index }}]" class="form-control"
                                            value="{{ $item->qty }}" min="0" max="{{ $item->qty }}" required>
                                    </td>
                                    <td>
                                        <select name="uom[{{ $item->index }}]" class="form-control" required>
                                            @foreach ($uoms as $uom)
                                                <option value="{{ $uom->id }}"
                                                    {{ $item->unit_of_measure_id == $uom->id ? 'selected' : '' }}>
                                                    {{ $uom->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" id="submitBtn" class="btn btn-primary">Save</button>
                            <a href="{{ route('gr.index') }}" class="btn btn-warning">Cancel Document</a>
                            <a href="{{ route('gr.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#submitBtn').on('click', function() {
                // Serialize form data
                var formData = $('#goodReceiptForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('gr.store') }}",
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Good Receipt saved successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ route('gr.index') }}"; // Redirect to index page
                            }
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        var errorMessages = [];

                        // Collect error messages
                        $.each(errors, function(key, value) {
                            errorMessages.push(value[0]);
                        });
                        var formattedErrors = '';
                        if (errorMessages.length > 0) {
                            formattedErrors = errorMessages.slice(0, -1).join(', ');
                            if (errorMessages.length > 1) {
                                formattedErrors += ', and ' + errorMessages[errorMessages
                                    .length - 1];
                            } else {
                                formattedErrors += errorMessages[0];
                            }
                        }

                        // Display all error messages using SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: formattedErrors,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }


                });
            });
        });
    </script>
@endsection
