@extends('layout.app')
@section('pagetitle', 'Users')

@section('mainbody')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <table class="table table-bordered table-responsive table-striped">
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
                                {{-- <td> --}}
                                    {{-- This is the button for users edit and delete --}}
                                    {{-- <a href="#edit{{ $user->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    @include('user-management.users.edit')
                                    <a href="#delete{{ $user->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('user-management.users.delete')
                                </td> --}}
                                <td>Active/Inactive</td>
                            </tr>
                        @endforeach

                        {{-- @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
