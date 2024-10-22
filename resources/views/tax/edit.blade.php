@extends('layouts.index')

@section('title')
    Edit Tax
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('tax.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('tax.update', $tax->id) }}">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" aria-describedby="name" name="name"
                                    value="{{ old('name', $tax->name) }}">
                                @error('name')
                                    <span id="name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rate" class="form-label">Rate</label>
                                <input type="text" class="form-control @error('rate') is-invalid @enderror"
                                    id="rate" aria-describedby="rate" name="rate"
                                    value="{{ old('rate', $tax->rate) }}">
                                @error('rate')
                                    <span id="rate" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input name="is_active" type="checkbox" id="is_active"
                                {{ old('is_active', $tax->is_active) ? 'checked' : '' }}>
                            <label for="is_active">
                                Status
                            </label>
                        </div>
                        @error('is_active')
                            <span id="is_active" class="error invalid-feedback">{{ $message }}</span>
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
