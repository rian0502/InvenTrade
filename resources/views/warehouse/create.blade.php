@extends('layouts.index')

@section('title')
    Create Warehouse
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('warehouse.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('warehouse.store') }}">
                <div class="card-body">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Warehouse Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" aria-describedby="name" name="name" value="{{ old('name', '') }}">
                                @error('name')
                                    <span id="name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label for="staff_id" class="form-label">Warehouse Coordinator</label>
                                        <select id="staff_id"
                                            class="form-control select2bs4 @error('staff_id') is-invalid @enderror"
                                            style="width: 100%;" name="staff_id">
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('staff_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('staff_id')
                                            <span id="staff_id" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group mt-2">
                                        <label for="staff_id" class="form-label"></label>
                                        <a href="{{ route('user.create') }}" data-toggle="tooltip" data-placement="bottom"
                                            title="Add User" class="form-control btn btn-success"><i
                                                class="bi bi-plus-square"></i></a>
                                        @error('staff_id')
                                            <span id="staff_id" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea aria-describedby="address" class="form-control  @error('address') is-invalid @enderror" id="address"
                            rows="3" name="address">{{ old('address', '') }}</textarea>
                        @error('address')
                            <span id="address" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
