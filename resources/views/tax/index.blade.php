@extends('layouts.index')
@section('title')
    Taxes
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('tax.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> Tax</a>
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
                        @foreach ($taxes as $tax)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $tax->name }}</td>
                                <td class="text-right">{{ $tax->rate }}</td>
                                <td class="text-center">
                                    @if ($tax->is_active == 1)
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
                                            <a class="dropdown-item" href="{{ route('tax.edit', $tax->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('tax.destroy', $tax->id) }}" method="post">
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
