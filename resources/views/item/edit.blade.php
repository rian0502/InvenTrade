@extends('layouts.index')

@section('title')
    Edit Item
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('item.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('item.update', $item->id) }}">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            aria-describedby="name" name="name" value="{{ old('name', $item->name) }}">
                        @error('name')
                            <span id="name" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" class="form-control select2bs4 @error('category_id') is-invalid @enderror"
                            style="width: 100%;" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id', $item->category_id) == $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span id="category_id" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="uom_id" class="form-label">Unit Of Measure</label>
                        <select id="uom_id" class="form-control select2bs4 @error('uom_id') is-invalid @enderror"
                            style="width: 100%;" name="uom_id">
                            @foreach ($uoms as $uom)
                                <option value="{{ $uom->id }}" @if (old('uom_id', $item->uom_id) == $uom->id) selected @endif>
                                    {{ $uom->name }}</option>
                            @endforeach
                        </select>
                        @error('uom_id')
                            <span id="uom_id" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                            id="description" rows="3" name="description">{{ old('description', $item->description) }}</textarea>
                        @error('description')
                            <span id="description" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="icheck-primary d-inline">
                            <input name="is_active" type="checkbox" id="is_active"
                                {{ old('is_active', $warehouse->is_active) ? 'checked' : '' }}>
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
