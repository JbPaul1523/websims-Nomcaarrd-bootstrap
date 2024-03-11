@extends('layout.app')
@section('pagetitle', 'Employee')

@section('mainbody')
    <div class="container">
        <div class="row">
            <a href="{{ route('employee.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Employee</a>
            <div class="col-md-12 col-md-offset-1">
                <table class="table table-bordered table-responsive table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Position</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>

                                <td>
                                    {{-- <a href="#edit{{$users->id}}" data-bs-toggle="modal" class="btn btn-success"><i class='fa fa-edit'></i> Edit</a>
                            <a href="#delete{{$users->id}}" data-bs-toggle="modal" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</a>
                            @include('websims-page.user_management.action') --}}

                                </td>
                            </tr>
                        @endforeach

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
