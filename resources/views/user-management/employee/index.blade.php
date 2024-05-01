@extends('layout.app')
@section('pagetitle', 'Employee')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                <i class="fa fa-plus"></i> Add Employee
            </button>

            <!-- Modal for adding new employee -->
           @include('user-management.employee.create')

            <!-- Employee list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-bordered table-responsive table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <a href="{{route('employee.show', $employee->id)}}" data-bs-toggle="modal" data-bs-target="#show{{ $employee->id }}">
                                        {{ $employee->name }}
                                    </a>
                                </td>
                                <td>{{ $employee->position }}</td>
                                <td>
                                    {{-- This is the button for users edit and delete --}}
                                    <a href="#edit{{ $employee->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $employee->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('user-management.employee.delete')
                                    @include('user-management.employee.edit')
                                    @include('user-management.employee.show')
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
