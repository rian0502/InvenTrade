@extends('layouts.index')
@section('title')
    Purchase Orders
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('po.create') }}" class="btn btn-primary">
                    <span class="left badge"><i class="fas fa-plus-square"></i></span> Purchase Order
                </a>
            </div>
            <div class="card-body">
                <table id="po-table" class="table table-striped">
                    <thead>
                        <th class="text-center">No</th>
                        <th>Number</th>
                        <th class="text-center">Status</th>
                        <th>PO Date</th>
                        <th>Payment</th>
                        <th>Amount</th>
                        <th>Vendor</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
