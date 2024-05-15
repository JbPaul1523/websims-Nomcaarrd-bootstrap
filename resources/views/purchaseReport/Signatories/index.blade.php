@extends('layout.app')
@section('pagetitle', 'Purchase Reports Signatory')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPrSignatoryModal">
                <i class="fa fa-plus"></i> Add PR Signatory
            </button>


            <!-- Modal for adding new Equipment -->
            @include('purchaseReport.Signatories.create')

            <!-- Equipment list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-bordered table-responsive table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($signatories as $signatory)
                            <tr>
                                <td>{{ $signatory->id }}</td>
                                <td>{{ $signatory->name }}</td>
                                <td>{{ $signatory->position }}</td>




                                <!-- Display employee name -->
                                <td>
                                    {{-- This is the button for users edit and delete --}}
                                    <a href="#edit{{ $signatory->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $signatory->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('purchaseReport.Signatories.delete')
                                    @include('purchaseReport.Signatories.edit')
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
