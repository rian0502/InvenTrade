@extends('layouts.index')

@section('title')
    Create Unit of Measurement
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('uom.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('uom.update', $uom->id) }}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">UoM Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            placeholder="ex: Kg, M, L, Pcs, etc" aria-describedby="name" name="name"
                            value="{{ old('name', $uom->name) }}">
                        @error('name')
                            <span id="name" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                            id="description" rows="3" name="description">{{ old('description', $uom->description) }}</textarea>
                        @error('description')
                            <span id="description" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input name="is_active" type="checkbox" id="is_active"
                                {{ old('is_active', $uom->is_active) ? 'checked' : '' }}>
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
