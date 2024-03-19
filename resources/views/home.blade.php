@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 mt-3">
                                <a href="{{ route('teacher.index') }}" class="btn btn-primary d-flex justify-content-center align-items-center"
                                    style="height: 70px;">Teachers</a>
                            </div>
                            <div class="col-4 mt-3">
                                <a href="" class="btn btn-primary d-flex justify-content-center align-items-center"
                                    style="height: 70px;">Teachers</a>
                            </div>
                            <div class="col-4 mt-3">
                                <a href="" class="btn btn-primary d-flex justify-content-center align-items-center"
                                    style="height: 70px;">Teachers</a>
                            </div>
                            <div class="col-4 mt-3">
                                <a href="" class="btn btn-primary d-flex justify-content-center align-items-center"
                                    style="height: 70px;">Teachers</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
