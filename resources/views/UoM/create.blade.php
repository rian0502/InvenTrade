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
            <form method="POST" action="{{ route('uom.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">UoM Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="ex: Kg, M, L, Pcs, etc"
                            aria-describedby="name" name="name" value="{{ old('name', '') }}">
                        @error('name')
                            <span id="name" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                            id="description" rows="3" name="description">{{ old('description', '') }}</textarea>
                        @error('description')
                            <span id="description" class="error invalid-feedback">{{ $message }}</span>
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
