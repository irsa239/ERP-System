<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Zentro | Performance Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            height: 60px;
        }
        .company-info {
            text-align: center;
            margin-top: 5px;
        }
        .company-info h1 {
            margin: 5px 0;
            font-size: 24px;
            color: #333;
        }
        .company-info p {
            margin: 2px 0;
            font-size: 13px;
            color: #666;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        {{-- Logo if available --}}
        {{-- <img src="{{ public_path('logo.png') }}" alt="Zentro Logo"> --}}
        
        <div class="company-info">
            <h1>Zentro</h1>
            <p>Professional ERP Solutions</p>
            <p>123 Main Road, Lahore, Pakistan</p>
            <p>Email: info@zentro.com | Phone: +92-300-1234567</p>
        </div>
    </div>

    <h2>Employee Performance Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Score</th>
                <th>Feedback</th>
                <th>Month</th>
            </tr>
        </thead>
        <tbody>
            @foreach($performances as $index => $performance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $performance->employee->name }}</td>
                    <td>{{ $performance->score }}</td>
                    <td>{{ $performance->feedback }}</td>
                    <td>{{ \Carbon\Carbon::parse($performance->month)->format('F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Zentro ERP System — Performance Report Generated on {{ now()->format('d M, Y') }}
    </div>

</body>
</html>
