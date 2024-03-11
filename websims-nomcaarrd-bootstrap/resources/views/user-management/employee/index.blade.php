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
            <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('employee.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Position:</label>
                                        <input type="text" class="form-control" name="position">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employee list -->
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
