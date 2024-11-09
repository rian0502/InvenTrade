@extends('layouts.index')
@section('title')
    Inventory
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table id="inventory-table" class="table table-striped">
                    <thead>
                        <th class="text-center">No</th>
                        <th>Item</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Measure</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
