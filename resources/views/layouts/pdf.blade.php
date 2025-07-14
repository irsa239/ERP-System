<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Payslip')</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 6px 10px;
            text-align: left;
        }
        h1, h3 {
            margin-bottom: 5px;
        }
        p {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
