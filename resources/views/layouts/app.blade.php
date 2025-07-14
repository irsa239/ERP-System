<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">
            <a href="/" class="font-bold text-lg">ERP Dashboard</a>
        </div>
    </nav>
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>
</html>
