@extends('layouts.index')

@section('title')
    Create Period
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('period.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('period.store') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="form-label">Start Date Period</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                    aria-describedby="start_date" name="start_date" value="{{ old('start_date', '') }}">
                                @error('start_date')
                                    <span id="start_date" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="form-label">End Date Period</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                                    aria-describedby="end_date" name="end_date" value="{{ old('end_date', '') }}">
                                @error('end_date')
                                    <span id="end_date" class="error invalid-feedback">{{ $message }}</span>
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
