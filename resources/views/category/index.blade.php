@extends('layout.app')
@section('pagetitle', 'Categories')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fa fa-plus"></i> Add Category
            </button>

            <!-- Modal for adding new Category -->
           @include('category.create')

            <!-- Category list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="mytable" class="table table-bordered table-responsive table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($category as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    {{-- This is the button for users edit and delete --}}
                                   <a href="#edit{{ $category->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                            class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{ $category->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                            class='fa fa-trash'></i> Delete</a>
                                    @include('category.delete')  {{----}}
                                    @include('category.edit')
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
