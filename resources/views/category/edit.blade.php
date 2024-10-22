@extends('layouts.index')

@section('title')
    Edit Category
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('category.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('category.update', $category->id) }}">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            aria-describedby="name" name="name" value="{{ old('name', $category->name) }}">
                        @error('name')
                            <span id="name" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                            id="description" rows="3" name="description">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <span id="description" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_active" value="1"
                            {{ old('is_active', $category->is_active) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1"><b>Status</b></label>
                    </div>                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
