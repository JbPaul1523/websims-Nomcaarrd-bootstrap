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
                                `<a href="/equipment_reports/${report.id}/download" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Download
                                </a>
                                <form action="/equipment_reports/${report.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>`
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
    </script>
@endsection
