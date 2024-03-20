@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Classroom</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('classroom.update', $classroom->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="room_code" class="col-md-4 col-form-label text-md-right">Room Code</label>

                                <div class="col-md-6">
                                    <input id="room_code" type="text"
                                        class="form-control @error('room_code') is-invalid @enderror" name="room_code"
                                        value="{{ old('room_code', $classroom->room_code) }}">

                                    @error('room_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="room_name" class="col-md-4 col-form-label text-md-right">Room Name</label>

                                <div class="col-md-6">
                                    <input id="room_name" type="text"
                                        class="form-control @error('room_name') is-invalid @enderror" name="room_name"
                                        value="{{ old('room_name', $classroom->room_name) }}">

                                    @error('room_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="capacity" class="col-md-4 col-form-label text-md-right">Capacity</label>

                                <div class="col-md-6">
                                    <input id="capacity" type="text"
                                        class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                                        value="{{ old('capacity', $classroom->capacity) }}">

                                    @error('capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Add other form fields here -->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update Classroom</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
