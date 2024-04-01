@extends('layout.app')
@section('pagetitle', 'Dashboard')

@section('mainbody')
    <div class="content-fluid">
        <div class="row">

            {{-- This box is for Users count --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>
                            {{$userCount}}
                        </h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="{{route('users')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- This box is for Total numbers of Employee --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>
                            {{$employeeCount}}
                        </h3>
                        <p>Total Employee</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('employees')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>{{$equipmentCount}}</h3>
                        <p>Total Equipment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <a href="{{route('equipments')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>{{$supplyCount}}</h3>
                        <p>Total Supplies</p>
                    </div>
                    <div class="icon">
                        <i class="fas fas fa-th"></i>
                    </div>
                    <a href="{{route('supplies')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{$categoryCount}}</h3>
                        <p>Total Category</p>
                    </div>
                    <div class="icon">
                        <i class="fas fas fa-file-pdf"></i>
                    </div>
                    <a href="{{route('categories')}}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    @endsection
