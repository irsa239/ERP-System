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
  <button type="submit"
    class="px-6 py-2 rounded hover:opacity-90"
    style="background-color: #07d5b6; color: black; border: 1px solid black;">
    Add Employee
  </button>
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

@endsection
