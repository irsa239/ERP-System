@extends('layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Employee Management</h2>

<!-- Employee Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-10">
    <h3 class="text-xl font-semibold mb-4">Add New Employee</h3>
    <form method="POST" action="{{ route('employees.store') }}" class="grid grid-cols-2 gap-6">
        @csrf
        <div>
            <label class="block text-sm font-medium">Full Name</label>
            <input type="text" name="name" class="w-full border rounded px-4 py-2 mt-1" required>
        </div>
        <div>
            <label class="block text-sm font-medium">CNIC</label>
            <input type="text" name="cnic" class="w-full border rounded px-4 py-2 mt-1" placeholder="xxxxx-xxxxxxx-x" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Designation</label>
            <input type="text" name="designation" class="w-full border rounded px-4 py-2 mt-1" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Joining Date</label>
            <input type="date" name="joining_date" class="w-full border rounded px-4 py-2 mt-1" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Salary (PKR)</label>
            <input type="number" name="salary" class="w-full border rounded px-4 py-2 mt-1" required>
        </div>
        <div class="col-span-2 text-right">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Add Employee</button>
        </div>
    </form>
</div>

<!-- Employee List Table -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4">All Employees</h3>
    <table class="min-w-full table-auto border border-gray-300 text-sm">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">CNIC</th>
                <th class="px-4 py-2 border">Designation</th>
                <th class="px-4 py-2 border">Joining Date</th>
                <th class="px-4 py-2 border">Salary</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $emp->id }}</td>
                    <td class="px-4 py-2 border">{{ $emp->name }}</td>
                    <td class="px-4 py-2 border">{{ $emp->cnic }}</td>
                    <td class="px-4 py-2 border">{{ $emp->designation }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($emp->joining_date)->format('d M, Y') }}</td>
                    <td class="px-4 py-2 border">Rs. {{ number_format($emp->salary) }}</td>
                    <td class="px-4 py-2 border space-x-2">
                        <a href="{{ route('employees.edit', $emp->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('employees.destroy', $emp->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if($employees->isEmpty())
                <tr>
                    <td colspan="7" class="text-center text-gray-500 py-4">No employees found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

   
<!-- Footer Section -->
<footer class="bg-blue-900 text-white mt-16">
    <div class="container mx-auto px-6 py-12 grid md:grid-cols-4 gap-8 text-sm">
        
        <!-- About Company -->
        <div>
            <h3 class="text-lg font-semibold mb-4">SmartStaff ERP</h3>
            <p>SmartStaff is a smart and scalable Human Resource Management System designed to automate your office’s HR tasks efficiently.</p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="/" class="hover:text-gray-300">Home</a></li>
                <li><a href="/login" class="hover:text-gray-300">Login</a></li>
                <li><a href="/register" class="hover:text-gray-300">Register</a></li>
                <li><a href="/contact" class="hover:text-gray-300">Contact</a></li>
            </ul>
        </div>

        <!-- ERP Modules -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Modules</h3>
            <ul class="space-y-2">
                <li><a href="/employees" class="hover:text-gray-300">Employee Management</a></li>
                <li><a href="/attendance" class="hover:text-gray-300">Attendance Tracking</a></li>
                <li><a href="/leave" class="hover:text-gray-300">Leave Management</a></li>
                <li><a href="/salary" class="hover:text-gray-300">Payroll System</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Contact</h3>
            <ul class="space-y-2">
                <li><span class="block">📍 123 Office Street, Karachi, Pakistan</span></li>
                <li><span class="block">📞 +92 321 1234567</span></li>
                <li><span class="block">✉️ support@smartstaff.com</span></li>
            </ul>
        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="bg-blue-800 text-center text-gray-300 text-xs py-4">
        &copy; {{ date('Y') }} SmartStaff ERP. All rights reserved.
    </div>
</footer>

@endsection
