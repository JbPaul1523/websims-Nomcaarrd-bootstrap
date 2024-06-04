@extends('layout.app')
@section('pagetitle', 'Supplies Report')

@section('mainbody')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
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

                <div class="d-flex" style="width: 100%">
                    <div class="container">
                        <label for="filter-period" class="form-label">Filter by:</label>
                        <select id="filter-period" class="form-select">
                            @php
                                $requestFilter = isset($filter) ? $filter : null;
                            @endphp
                            {{--
                            -Customize monthy, quarterly, semi, annual here
                            -requestFilter will be the data
                            --}}
                            <option value="all">All</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="annually">Annually</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end" style="margin-left: 20px; width: 100%">
                        <button class="btn bg-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                              </svg>
                            Print
                        </button>
                    </div>
                </div>

                <table id="reportTable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>File Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Reports will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this report?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#reportTable').DataTable();

            function loadReports(period) {
                $.ajax({
                    url: '{{ route('supply_reports.getReports') }}',
                    method: 'GET',
                    data: {
                        period: period
                    },
                    success: function(data) {
                        table.clear();
                        data.forEach(function(report) {
                            table.row.add([
                                report.id,
                                report.file_name,
                                `<a href="/supply_reports/view/${report.id}" class="btn btn-info" target="_blank">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="/supply_reports/${report.id}/download" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Download
                                </a>
                                <button class="btn btn-danger" onclick="confirmDelete(${report.id})">
                                    <i class="fa fa-trash"></i> Delete
                                </button>`
                            ]).draw(false);
                        });
                    }
                });
            }

            $('#filter-period').on('change', function() {
                var period = $(this).val();
                loadReports(period);
            });

            // Initial load
            loadReports('all');

            // Optionally, refresh the table every few seconds
            setInterval(function() {
                var period = $('#filter-period').val();
                loadReports(period);
            }, 5000); // Refresh every 5 seconds
        });

        function confirmDelete(id) {
            var url = '/supply_reports/' + id;
            $('#deleteForm').attr('action', url);
            $('#deleteModal').modal('show');
        }

        // expand filtering out data here
        function selectReport(e) {
            // Create a new FormData object
            var formData = new FormData();

            // Append data to the FormData object
            formData.append('date', e.value);

            $.ajax({
                url: '/your-api-endpoint', // Specify the URL to which you want to send the request
                method: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from automatically processing the data
                contentType: false, // Set content type to false to prevent jQuery from setting the Content-Type header
                success: function(response) {
                    // Handle the success response here
                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
