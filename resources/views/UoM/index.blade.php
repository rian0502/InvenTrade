@extends('layouts.index')
@section('title')
    Unit of Measurement
@endsection


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('uom.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> UoM</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead class="text-primary">
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($uoms as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->symbol }}</td>
                                <td>
                                    @if ($item->is_active == 1)
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
                                            <a class="dropdown-item" href="{{ route('uom.edit', $item->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('uom.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item bg-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
