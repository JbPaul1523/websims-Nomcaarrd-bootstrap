@extends('layout.app')
@section('pagetitle', 'Purchase Reports Categories')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPrCategoryModal">
                <i class="fa fa-plus"></i> Add Category

            <!-- Modal for adding new Equipment -->
            @include('purchaseReport.Categories.create')

            <!-- Equipment list -->
            {{-- <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-bordered table-responsive table-striped">
                    <thead>
                        <th>Pr No.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th> --}}
                        {{-- <th>Supplies</th>
                        <th>Category</th>
                        <th>Employee</th>
                        <th>Equipments</th> --}}
                        {{-- <th>Create at</th>
                        <th>Updated at</th>
                    </thead>
                    <tbody>
                        @foreach ($purchaseReports as $purchaseReport)
                            <tr>
                                <td>{{ $purchaseReport->pr_no }}</td>
                                <td>{{ $purchaseReport->name }}</td>
                                <td>{{ $purchaseReport->description }}</td>
                                <td>{{ $purchaseReport->category}}</td>
                                <td>{{ $purchaseReport->created_at}}</td>
                                <td>{{ $purchaseReport->updated_at}}</td> --}}

                                {{-- <td>{{ $purchaseReport->asset_id }}</td>
                                <td>{{ $purchaseReport->category_id }}</td>
                                <td>{{ $purchaseReport->employee_id }}</td> --}}
                                {{-- <td>@if ($equipment->categories_id)
                                    @foreach ($categories as $category)
                                        @if ($category->id === $equipment->categories_id)
                                            {{ $category->name }}
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    N/A
                                @endif</td>
                                <td>
                                    @if ($equipment->employees_id)
                                        @foreach ($employees as $employee)
                                            @if ($employee->id === $equipment->employees_id)
                                                {{ $employee->name }}
                                                @break
                                            @endif
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td> --}}
                                 <!-- Display employee name -->
                                {{-- <td> --}}
                                    {{-- This is the button for users edit and delete --}}
                                    {{-- <a href="#edit{{ $equipment->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $equipment->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('items.equipment.delete')
                                    @include('items.equipment.edit')
                                </td> --}}
                            {{-- </tr>
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

                </table> --}}

            </div>
        </div>
    </div>


@endsection
