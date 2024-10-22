@extends('layouts.index')
@section('title')
    Period
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('period.create') }}" class="btn btn-primary"><span class="left badge"><i
                            class="fas fa-plus-square"></i></span> Periode</a>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead class=" text-primary">
                        <th class="text-center">No</th>
                        <th>Period</th>
                        <th>Closing</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($periods as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->start_date }} - {{ $item->end_date }}</td>
                                <td>
                                    @if ($item->is_closed == 1)
                                        <span class="badge badge-danger">Closed</span>
                                    @else
                                        <span class="badge badge-success">Open</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ route('period.edit', $item->id) }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('period.destroy', $item->id) }}" method="post">
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
