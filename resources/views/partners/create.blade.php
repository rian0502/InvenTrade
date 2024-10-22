@extends('layouts.index')

@section('title')
    Create Partner
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('partner.index') }}" class="btn btn-danger"><span class="left badge"><i
                            class="fas fa-arrow-left"></i></span> Back</a>
            </div>
            <form method="POST" action="{{ route('partner.store') }}">
                <div class="card-body">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Partner Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    aria-describedby="name" name="name" value="{{ old('name', '') }}">
                                @error('name')
                                    <span id="name" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Partner Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    aria-describedby="email" name="email" value="{{ old('email', '') }}">
                                @error('email')
                                    <span id="email" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person"
                                    aria-describedby="contact_person" name="contact_person" value="{{ old('contact_person', '') }}">
                                @error('contact_person')
                                    <span id="contact_person" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    aria-describedby="phone" name="phone" value="{{ old('phone', '') }}">
                                @error('phone')
                                    <span id="phone" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea aria-describedby="description" class="form-control  @error('description') is-invalid @enderror"
                                    id="description" rows="3" name="description">{{ old('description', '') }}</textarea>
                                @error('description')
                                    <span id="description" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea aria-describedby="address" class="form-control  @error('address') is-invalid @enderror"
                                    id="address" rows="3" name="address">{{ old('address', '') }}</textarea>
                                @error('address')
                                    <span id="address" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="is_supplier" class="form-label">Vendor or Customer</label>
                                
                                <select class="form-control @error('is_supplier') is-invalid @enderror" id="is_supplier" name="is_supplier">
                                    <option value="1" {{ old('is_supplier') == 'vendor' ? 'selected' : '' }}>Vendor</option>
                                    <option value="0" {{ old('is_supplier') == 'customer' ? 'selected' : '' }}>Customer</option>
                                </select>
                                @error('is_supplier')
                                    <span id="is_supplier" class="error invalid-feedback">{{ $message }}</span>
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
