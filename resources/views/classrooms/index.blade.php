@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Classrooms
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-body">
                        <a href="{{ $action }}" class="btn btn-primary mb-3">Create New</a>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room Code</th>
                                        <th>Room Name</th>
                                        <th>Capacity</th>
                                        <th style="width: 20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classrooms as $classroom)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $classroom->room_code }}</td>
                                            <td>{{ $classroom->room_name }}</td>
                                            <td>{{ $classroom->capacity }}</td>
                                            <td>
                                                <a href="{{ route('classroom.edit', $classroom->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('classroom.destroy', $classroom->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this classroom?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
