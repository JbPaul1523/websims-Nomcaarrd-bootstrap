@extends('layout.app')
@section('pagetitle', 'Equipment Reports')

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

                <div class="mb-3">
                    <label for="filter-period" class="form-label">Filter by:</label>
                    <select id="filter-period" class="form-select">
                        <option value="all">All</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="annually">Annually</option>
                    </select>
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
                    url: '{{ route('equipment_reports.getReports') }}',
                    method: 'GET',
                    data: { period: period },
                    success: function(data) {
                        table.clear();
                        data.forEach(function(report) {
                            table.row.add([
                                report.id,
                                report.file_name,
                                `
                                <a href="/equipment_reports/view/${report.id}" class="btn btn-info" target="_self">
                                    <i class="fa fa-eye"></i> View
                                </a>
                                <a href="/equipment_reports/${report.id}/download" class="btn btn-primary">
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
            var url = '/equipment_reports/' + id;
            $('#deleteForm').attr('action', url);
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
