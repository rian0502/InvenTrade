@extends('layouts.index')
@section('title')
    Warehouse
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('warehouse.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> Warehouse</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead class="text-primary">
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Staff</th>
                        <th class="text-center">Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->staff->name }}</td>
                                <td class="text-center">
                                    @if ($warehouse->is_active == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('warehouse.edit', $warehouse->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('warehouse.destroy', $warehouse->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item bg-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
