@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Major</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('major.store') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="major_code" class="col-md-4 col-form-label text-md-right">Major Code</label>

                                <div class="col-md-6">
                                    <input id="major_code" type="text"
                                        class="form-control @error('major_code') is-invalid @enderror" name="major_code"
                                        value="{{ old('major_code') }}">

                                    @error('major_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="major_name" class="col-md-4 col-form-label text-md-right">Major Name</label>

                                <div class="col-md-6">
                                    <input id="major_name" type="text"
                                        class="form-control @error('major_name') is-invalid @enderror" name="major_name"
                                        value="{{ old('major_name') }}">

                                    @error('major_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Add other form fields here -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Add Major</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
