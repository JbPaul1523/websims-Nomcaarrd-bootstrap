@extends('layout.app')
@section('pagetitle', 'Equipments')

@section('mainbody')
    <div class="container">
        <div class="row">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">
                <i class="fa fa-plus"></i> Add Equipment
            </button>

            <!-- Modal for adding new Equipment -->
            @include('items.equipment.create')

            <!-- Equipment list -->
            <div class="col-md-12 col-md-offset-1">
                <table id="equipTable" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Serial Number</th>
                        <th>Date Aquired</th>
                        <th>Condition</th>
                        <th>Category</th>
                        <th>Assigned to:</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($equipments as $equipment)
                            <tr>
                                <td>{{ $equipment->id }}</td>
                                <td>
                                    <a href="{{ route('equipment.show', $equipment->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#show{{ $equipment->id }}">
                                        {{ $equipment->name }}
                                    </a>
                                </td>
                                <td>{{ $equipment->description }}</td>
                                <td>{{ $equipment->serial_number }}</td>
                                <td>{{ $equipment->date_acquired }}</td>
                                <td>{{ $equipment->condition }}</td>
                                <td>
                                    @if ($equipment->categories_id)
                                        @foreach ($categories as $category)
                                            @if ($category->id === $equipment->categories_id)
                                                {{ $category->name }}
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($equipment->employees_id)
                                    @foreach ($employees as $employee)
                                        @if ($employee->id === $equipment->employees_id)
                                            {{ $employee->name }}
                                        @break
                                    @endif
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td> <!-- Display employee name -->
                        <td>
                            {{-- This is the button for users edit and delete --}}
                            <a href="#edit{{ $equipment->id }}" data-bs-toggle="modal" class="btn btn-success"><i
                                    class='fa fa-edit'></i> Edit</a>
                            <a href="#delete{{ $equipment->id }}" data-bs-toggle="modal" class="btn btn-danger"><i
                                    class='fa fa-trash'></i> Delete</a>
                            @include('items.equipment.delete')
                            @include('items.equipment.edit')
                            @include('items.equipment.show')
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
<script>
    // Initialize All Tables
    $(document).ready(function() {
        // Initialize DataTable for #mytable
        $('#equipTable').DataTable({
          "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            order: [[0, 'desc']],


        });

    });
</script>

@endsection
