<!-- resources/views/items/assets/details.blade.php -->

<div>
    <h2>{{ $asset->name }}</h2>
    <p>{{ $asset->description }}</p>
    <p>Stock: {{ $asset->stock }}</p>
    <p>Amount: {{ $asset->amount }}</p>
    <p>Date Acquired: {{ $asset->date_acquired }}</p>

    <h3>Deduction History</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Deducted Amount</th>
                <th>Description/Purpose</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asset->deductions as $deduction)
                <tr>
                    <td>{{ $deduction->id }}</td>
                    <td>{{ $deduction->deducted_amount }}</td>
                    <td>{{ $deduction->description }}</td>
                    <td>{{ $deduction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
