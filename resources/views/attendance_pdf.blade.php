<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Attendance Report ({{ ucfirst($type) }}) - {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}</h3>
    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $att)
                <tr>
                    <td>{{ $att->employee->name ?? 'N/A' }}</td>
                    <td>{{ $att->date }}</td>
                    <td>{{ ucfirst($att->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
