@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Student</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('student.update', $student->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="student_id" class="col-md-4 col-form-label text-md-right">Student ID</label>

                                <div class="col-md-6">
                                    <input id="student_id" type="text"
                                        class="form-control @error('student_id') is-invalid @enderror" name="student_id"
                                        value="{{ old('student_id', $student->student_id) }}">

                                    @error('student_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="student_name" class="col-md-4 col-form-label text-md-right">Student Name</label>

                                <div class="col-md-6">
                                    <input id="student_name" type="text"
                                        class="form-control @error('student_name') is-invalid @enderror" name="student_name"
                                        value="{{ old('student_name', $student->student_name) }}">

                                    @error('student_name')
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
                                            <option value="{{ $major->id }}"
                                                {{ old('major_id', $student->major_id) == $major->id ? 'selected' : '' }}>
                                                {{ $major->major_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('major_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                                <div class="col-md-6">
                                    <select name="gender" id="gender"
                                        class="form-control @error('gender') is-invalid @enderror">
                                        <option value="">Select Gender</option>
                                        <option value="male"
                                            {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female"
                                            {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="place_of_birth" class="col-md-4 col-form-label text-md-right">Place of
                                    Birth</label>

                                <div class="col-md-6">
                                    <input id="place_of_birth" type="text"
                                        class="form-control @error('place_of_birth') is-invalid @enderror"
                                        name="place_of_birth"
                                        value="{{ old('place_of_birth', $student->place_of_birth) }}">

                                    @error('place_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Date of
                                    Birth</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}">

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address', $student->address) }}">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ old('phone_number', $student->phone_number) }}">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
