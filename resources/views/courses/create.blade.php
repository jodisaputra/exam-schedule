@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Course</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('course.store') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="course_code" class="col-md-4 col-form-label text-md-right">Course Code</label>

                                <div class="col-md-6">
                                    <input id="course_code" type="text"
                                        class="form-control @error('course_code') is-invalid @enderror" name="course_code"
                                        value="{{ old('course_code') }}">

                                    @error('course_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="course_name" class="col-md-4 col-form-label text-md-right">Course Name</label>

                                <div class="col-md-6">
                                    <input id="course_name" type="text"
                                        class="form-control @error('course_name') is-invalid @enderror" name="course_name"
                                        value="{{ old('course_name') }}">

                                    @error('course_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="major_id" class="col-md-4 col-form-label text-md-right">Major</label>

                                <div class="col-md-6">
                                    <select name="major_id" id="major_id"
                                        class="form-control @error('major_id') is-invalid @enderror">
                                        <option value="">Select Major</option>
                                        @foreach ($majors as $major)
                                            <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>{{ $major->major_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('major_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Add other form fields here -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Add Course</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
