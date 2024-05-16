@extends('layout.app')
@section('pagetitle', 'Purchase Report')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPrModal">
                <i class="fa fa-plus"></i> Add Purchase Report
            </button>

                <!-- Modal for adding new Equipment -->
                @include('purchaseReport.ManagePR.create')

                <!-- Equipment list -->
                <div class="col-md-12 col-md-offset-1">
                    <table id="mytable" class="table table-bordered table-responsive table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Pr No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Create</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($purchaseReports as $purchaseReport)
                                <tr>
                                    <td> {{ $purchaseReport->id }}</td>
                                    <td> {{ $purchaseReport->name }}</td>
                                    <td> {{ $purchaseReport->pr_no }}</td>
                                    <td> {{ $purchaseReport->category }}</td>
                                    <td> {{ $purchaseReport->create_at }}</td>



                                    <!-- Display employee name -->
                                    {{-- <td> --}}
                                        {{-- This is the button for users edit and delete --}}
                                        {{-- <a href="#edit{{ $equipment->id }}" data-bs-toggle="modal"
                                            class="btn btn-success"><i class='fa fa-edit'></i> Edit</a>
                                        <a href="#delete{{ $equipment->id }}" data-bs-toggle="modal"
                                            class="btn btn-danger"><i class='fa fa-trash'></i> Delete</a>
                                        @include('items.equipment.delete')
                                        @include('items.equipment.edit')
                                    </td> --}}
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
