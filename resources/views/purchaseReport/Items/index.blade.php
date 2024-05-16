@extends('layout.app')
@section('pagetitle', 'Purchase Reports Items')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPrItemModal">
                <i class="fa fa-plus"></i> Add PR Item
            </button>


            <!-- Modal for adding new Equipment -->
            @include('purchaseReport.Items.create')

            <!-- Equipment list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{$item->itemcategory}}</td>
                                <td>{{ $item->unit }}</td>



                                <!-- Display employee name -->
                                <td>
                                    {{-- This is the button for users edit and delete --}}
                                    <a href="#edit{{ $item->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $item->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('purchaseReport.Items.delete')
                                    @include('purchaseReport.Items.edit')
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
