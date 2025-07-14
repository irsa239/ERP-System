@extends('layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <!-- Total Employees -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-blue-600">
        <h3 class="text-sm font-semibold text-gray-500">Total Employees</h3>
        <p class="text-3xl font-bold text-blue-800 mt-2">{{ $employeeCount }}</p>
    </div>

    <!-- Total Leaves This Month -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-yellow-500">
        <h3 class="text-sm font-semibold text-gray-500">Leaves This Month</h3>
        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $leavesThisMonth }}</p>
    </div>

    <!-- Attendance Today -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-green-600">
        <h3 class="text-sm font-semibold text-gray-500">Present Today</h3>
        <p class="text-3xl font-bold text-green-700 mt-2">{{ $presentToday }}</p>
    </div>

    <!-- Salary Generated -->
    <div class="bg-white p-6 rounded shadow border-l-4 border-purple-600">
        <h3 class="text-sm font-semibold text-gray-500">Salaries Generated</h3>
        <p class="text-3xl font-bold text-purple-700 mt-2">Rs. {{ number_format($salaryTotal) }}</p>
    </div>
</div>

<!-- Charts and Tables -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    <!-- Attendance Summary Chart -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Weekly Attendance Overview</h2>
        <canvas id="attendanceChart" class="w-full h-64"></canvas>
    </div>

    <!-- Recent Leave Applications -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Recent Leave Requests</h2>
        <table class="w-full text-sm text-left text-gray-600">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">Employee</th>
                    <th class="py-2 px-4">Type</th>
                    <th class="py-2 px-4">From</th>
                    <th class="py-2 px-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentLeaves as $leave)
                    <tr>
                        <td class="py-2 px-4">{{ $leave->employee->name }}</td>
                        <td class="py-2 px-4">{{ $leave->leave_type }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($leave->from_date)->format('d M Y') }}</td>
                        <td class="py-2 px-4 capitalize">{{ $leave->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">No recent requests.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN and Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('attendanceChart').getContext('2d');
const attendanceChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: 'Present Employees',
            data: [20, 22, 19, 25, 23, 18, 21], // You can replace this with dynamic data
            borderColor: 'rgba(34, 197, 94, 1)',
            backgroundColor: 'rgba(34, 197, 94, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.3,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 5 }
            }
        }
    }
});
</script>
@endsection
