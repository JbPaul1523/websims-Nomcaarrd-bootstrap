@extends('layout.app')
@section('pagetitle', 'Add Employee')

@section('mainbody')

    <div class="container">
        <h3>
            Add New Employee
        </h3>
        <div class="row">
            <div class="form-area">
                <form method="POST" action="#">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Employee Name:</label>
                            <input type="text" class="form-control" name="emp_name">
                        </div>
                        <div class="col-md-6">
                            <label>Position:</label>
                            <div type="text" class="form-control" name="position">

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <input type="submit" class="btn btn-primary button" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
