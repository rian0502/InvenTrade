@extends('layouts.index')
@section('title')
    Purchase Orders
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('po.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> Purchase Order</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead class="text-primary">
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Rate</th>
                        <th class="text-center">Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
