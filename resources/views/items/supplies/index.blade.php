<!-- resources/views/items/assets/index.blade.php -->

@extends('layout.app')
@section('pagetitle', 'Assets')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                <i class="fa fa-plus"></i> Add Asset
            </button>

            <!-- Modal for adding new Asset -->
            @include('items.supplies.create')

            <!-- Asset list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="assetstable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Stock</th>
                        <th>Date Acquired</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($assets as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>{{ $asset->description }}</td>
                                <td>{{ $asset->amount }}</td>
                                <td>{{ $asset->stock }}</td>
                                <td>{{ $asset->date_acquired }}</td>
                                <td>
                                    <button class="btn btn-info view-asset" data-id="{{ $asset->id }}" data-bs-toggle="modal" data-bs-target="#assetModal"><i class='fa fa-eye'></i> View</button>
                                    <button class="btn btn-warning deduct-asset" data-id="{{ $asset->id }}" data-bs-toggle="modal" data-bs-target="#deductAssetModal"><i class='fa fa-minus'></i> Deduct</button>
                                </td>
                            </tr>
                        @endforeach
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

    <!-- Asset Details Modal -->
    <div class="modal fade" id="assetModal" tabindex="-1" aria-labelledby="assetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assetModalLabel">Asset Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Asset details will be loaded here via AJAX -->
                    <div id="assetDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Deduct Asset Modal -->
    <div class="modal fade" id="deductAssetModal" tabindex="-1" aria-labelledby="deductAssetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deductAssetModalLabel">Deduct Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Deduct asset form will be loaded here via AJAX -->
                    <div id="deductAssetForm"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#assetstable').DataTable({
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                order: [[0, 'desc']],
            });

            $('.view-asset').on('click', function() {
                const assetId = $(this).data('id');
                $.ajax({
                    url: '/assets/' + assetId,
                    method: 'GET',
                    success: function(data) {
                        $('#assetDetails').html(data);
                    }
                });
            });

            $('.deduct-asset').on('click', function() {
                const assetId = $(this).data('id');
                $.ajax({
                    url: '/assets/deduct-form/' + assetId,
                    method: 'GET',
                    success: function(data) {
                        $('#deductAssetForm').html(data);
                    }
                });
            });
        });
    </script>
@endsection
