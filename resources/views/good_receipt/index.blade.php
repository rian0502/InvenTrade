@extends('layouts.index')
@section('title')
    Good Receipt
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Partner</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $item)
                            
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->transaction_date }}</td>
                            <td>{{ $item->partner->name }}</td>
                            <td>
                                <a href="{{ route('gr.show', $item->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
