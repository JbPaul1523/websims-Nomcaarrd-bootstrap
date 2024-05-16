<!-- resources/views/supply_reports/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Manage Supply Reports</title>
</head>
<body>
    <h1>Manage Supply Reports</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->file_name }}</td>
                    <td>
                        <a href="{{ route('supply_reports.download', $report->id) }}">Download</a>
                        <form action="{{ route('supply_reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
