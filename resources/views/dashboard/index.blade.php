@extends('layout.app')
@section('pagetitle', 'Dashboard')

@section('mainbody')
    <div class=" container content-fluid">
        <div class="row">
            {{-- This box is for Users count --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>
                            {{ $userCount }}
                        </h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="{{ route('users') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            {{-- This box is for Total numbers of Employee --}}
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>
                            {{ $employeeCount }}
                        </h3>
                        <p>Total Employee</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ route('employees') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>{{ $equipmentCount }}</h3>
                        <p>Total Equipment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <a href="{{ route('equipments') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        {{-- This h3 is for number of data in the table --}}
                        <h3>{{ $supplyCount }}</h3>
                        <p>Total Supplies</p>
                    </div>
                    <div class="icon">
                        <i class="fas fas fa-th"></i>
                    </div>
                    <a href="{{ route('supplies') }}" class="small-box-footer">View <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="container d-flex">
                <div class="container">
                    <p class="mx-auto"> MONTHLY REPORT CHART</p>
                    <canvas id="myChart" width="500" height="250"></canvas>
                </div>
                &nbsp;
                <div class="container">
                    <p class="mx-auto"> EQUIPMENT-EMPLOYEE REPORT CHART</p>
                    <canvas id="myChart2" width="500" height="250"></canvas>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const data = @json(array_values($monthlyData));
            var ctx = document.getElementById('myChart').getContext('2d');
            var label = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEPT', 'OCT', 'NOV', 'DEC'];
            var myChart = new Chart(ctx, {
                type: 'bar', // Specify the chart type
                data: {
                    labels: label,
                    datasets: [{
                        data: data,
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                    aspectRatio: 2, // Width/Height ratio (e.g., 2 means width is twice the height)
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Turn off the legend
                        }
                    },
                }
            });

            var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar', // Specify the chart type
                data: {
                    labels: {!! json_encode($label) !!},
                    datasets: [{
                        label: 'Equipment Count', // Set a fixed label for the dataset
                        data: {!! json_encode($values) !!},
                        borderWidth: 1
                    }]
                },
                options: {

                    maintainAspectRatio: true,
                    aspectRatio: 2, // Width/Height ratio (e.g., 2 means width is twice the height)
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Turn off the legend
                        }
                    },
                }
            });
        </script>

    @endsection
