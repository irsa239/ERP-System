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

    <!-- Employee of the month -->

    <div class="bg-white p-6 rounded shadow mt-6">
    <h2 class="text-lg font-bold text-gray-700 mb-4">Top Performers</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($topPerformers as $employee)
            <div class="bg-green-50 p-4 rounded text-center">
                <img src="{{ $employee->profile_photo_url ?? 'https://via.placeholder.com/80' }}" alt="Profile" class="mx-auto rounded-full w-20 h-20 mb-2">
                <h3 class="font-semibold">{{ $employee->name }}</h3>
                <p class="text-sm text-gray-600">{{ $employee->position }}</p>
            </div>
        @endforeach
    </div>
</div>


 <!-- Work Anniversaries & Custom Events -->
<div class="bg-white p-6 rounded-2xl shadow-xl mt-6">
    <h2 class="text-xl font-bold text-gray-800 mb-5 flex items-center gap-2">
        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 7V3M16 7V3M4 11h16M4 19h16M4 15h16M4 7h16"></path>
        </svg>
        Upcoming Events
    </h2>
    <ul class="space-y-4">
        @forelse($upcomingEvents as $event)
            <li class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all">
                <div>
                    <p class="font-semibold text-gray-700">
                        {{ $event->title ?? ($event->employee->name ?? 'Unknown') }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $event->type }} &middot; 
                        <span class="text-indigo-500 font-medium">
                            {{ \Carbon\Carbon::parse($event->date)->format('d M') }}
                        </span>
                    </p>
                </div>
                @if(isset($event->years))
                    <span class="inline-block text-xs font-bold text-white bg-blue-500 rounded-full px-3 py-1">
                        {{ $event->years }} yrs
                    </span>
                @endif
            </li>
        @empty
            <li class="py-4 text-center text-gray-400">No upcoming events 🎉</li>
        @endforelse
    </ul>
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
