@extends('layouts.index')

@section('title')
    Edit Purchase Order
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('po.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('po.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conversion_name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('conversion_name') is-invalid @enderror"
                                    id="conversion_name" aria-describedby="conversion_name" name="conversion_name"
                                    value="{{ old('conversion_name', '') }}">
                                @error('conversion_name')
                                    <span id="conversion_name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conversion_value" class="form-label">Value</label>
                                <input type="text" class="form-control @error('conversion_value') is-invalid @enderror"
                                    id="conversion_value" aria-describedby="conversion_value" name="conversion_value"
                                    value="{{ old('conversion_value', '') }}">
                                @error('conversion_value')
                                    <span id="conversion_value" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_unit_id" class="form-label">From</label>
                                <select id="from_unit_id"
                                    class="form-control select2bs4 @error('from_unit_id') is-invalid @enderror"
                                    style="width: 100%;" name="from_unit_id">
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}"
                                            {{ old('from_unit_id') == $uom->id ? 'selected' : '' }}>
                                            {{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('from_unit_id')
                                    <span id="from_unit_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_unit_id" class="form-label">To</label>
                                <select id="to_unit_id"
                                    class="form-control select2bs4 @error('to_unit_id') is-invalid @enderror"
                                    style="width: 100%;" name="to_unit_id">
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->id }}"
                                            {{ old('to_unit_id') == $uom->id ? 'selected' : '' }}>
                                            {{ $uom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('to_unit_id')
                                    <span id="to_unit_id" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
