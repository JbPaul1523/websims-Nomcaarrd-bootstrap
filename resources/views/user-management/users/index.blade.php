@extends('layout.app')
@section('pagetitle', 'Users')

@section('mainbody')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <table id="useTable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        {{-- <th>Status</th> --}}

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>Active/Inactive</td> --}}
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Initialize All Tables
        $(document).ready(function() {
            // Initialize DataTable for #mytable
            $('#useTable').DataTable({
              "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                order: [[0, 'desc']],


            });

        });
    </script>
@endsection
