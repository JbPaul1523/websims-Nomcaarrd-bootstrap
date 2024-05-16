@extends('layout.app')
@section('pagetitle', 'Supplies Report')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSupplyModal">
                <i class="fa fa-plus"></i> Add Supply
            </button>

            <!-- Modal for adding new Equipment -->
            @include('items.supplies.create')

            <!-- Equipment list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="reportTable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Stock</th>
                        <th>Date Acquired</th>

                    </thead>
                    <tbody>
                        {{-- @foreach ($assets as $supply)
                            <tr>
                                <td>{{ $supply->id }}</td>
                                <td>{{ $supply->name }}</td>
                                <td>{{ $supply->description }}</td>
                                <td>{{ $supply->amount }}</td>
                                <td>{{ $supply->stock }}</td>
                                <td>{{ $supply->date_acquired }}</td> --}}
                                {{-- <td>
                                    This is the button for users edit and delete
                                    <a href="#edit{{ $supply->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $supply->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('items.supplies.delete')
                                    @include('items.supplies.edit')
                                </td> --}}
                            {{-- </tr>
                        @endforeach --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
