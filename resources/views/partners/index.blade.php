@extends('layouts.index')
@section('title')
    Partner
@endsection


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('partner.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> Partner</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead>
                        <th class="text-center">No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Vendor/Customer</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $partner->code }}</td>
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->phone }}</td>
                                <td>
                                    @if ($partner->is_supplier == 1)
                                        <span class="badge badge-success">Vendor</span>
                                    @else
                                        <span class="badge badge-primary">Customer</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($partner->is_active == 1)
                                        <span class="badge badge-primary">Active</span>
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
                                                href="{{ route('partner.edit', $partner->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('partner.destroy', $partner->id) }}" method="post">
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
