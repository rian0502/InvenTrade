@extends('layouts.index')
@section('title')
    Unit Conversion
@endsection


@section('content')

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('conversion.create') }}" class="btn btn-primary"><span class="left badge"><i
                                class="fas fa-plus-square"></i></span> Conversion</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <th class="text-center">No</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($conversions as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->conversion_name }}</td>
                                    <td>{{ $item->conversion_value }}</td>
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
                                                <a class="dropdown-item" href="{{ route('conversion.edit', $item->id) }}">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('conversion.destroy', $item->id) }}" method="post">
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
