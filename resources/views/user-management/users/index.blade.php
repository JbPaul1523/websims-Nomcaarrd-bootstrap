@extends('layout.app')
@section('pagetitle', 'Users')

@section('mainbody')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-bordered table-responsive table-striped" style="width:100%">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>Active/Inactive</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
