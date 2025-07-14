@extends('layout')

@section('title', 'Help & Support')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Help & Support</h1>

    {{-- Help Cards --}}
    <div class="grid md:grid-cols-3 gap-6 mb-10">
        {{-- Reset Password --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3 1.343 3 3v2H9v-2c0-1.657 1.343-3 3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8V6a5 5 0 00-10 0v2" />
                    <rect width="20" height="12" x="2" y="10" rx="2" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Reset Password</h3>
            </div>
            <p class="text-sm text-gray-600">Click "Forgot Password" on the login screen to receive a reset email.</p>
        </div>

        {{-- Add Employee --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9a3 3 0 11-6 0 3 3 0 016 0zm2 12a9 9 0 10-18 0h18zM12 12v6m3-3H9" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Add New Employee</h3>
            </div>
            <p class="text-sm text-gray-600">Go to Employees → click “Add New” → Fill form and save.</p>
        </div>

        {{-- Generate Reports --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2h6v2m2 0a2 2 0 002-2v-4a2 2 0 00-2-2h-1V7a2 2 0 00-2-2H8a2 2 0 00-2 2v2H5a2 2 0 00-2 2v4a2 2 0 002 2h2" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Generate Reports</h3>
            </div>
            <p class="text-sm text-gray-600">Select filters on Reports page to view attendance, leave, or salary records.</p>
        </div>

        {{-- Mark Attendance --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-6-8h6M4 6h16M4 18h16M4 10h16M4 14h16" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Mark Attendance</h3>
            </div>
            <p class="text-sm text-gray-600">Use the Attendance module to mark Present, Absent, or Half-Day.</p>
        </div>

        {{-- Apply Leave --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Apply for Leave</h3>
            </div>
            <p class="text-sm text-gray-600">Go to Leave → Apply Leave → Fill form → Submit for approval.</p>
        </div>

        {{-- View Salary --}}
        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
            <div class="flex items-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.333 0 2-.667 2-2s-.667-2-2-2-2 .667-2 2 .667 2 2 2zm0 4c-1.333 0-2 .667-2 2s.667 2 2 2 2-.667 2-2-.667-2-2-2zm0 4c-1.333 0-2 .667-2 2s.667 2 2 2 2-.667 2-2-.667-2-2-2z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">View Salary</h3>
            </div>
            <p class="text-sm text-gray-600">Open the Salary module → Select Month → View net salary and details.</p>
        </div>
    </div>

    {{-- Contact Section --}}
    <div class="bg-gray-100 p-6 rounded shadow text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-3">Still Need Help?</h2>
        <p class="text-gray-700 mb-2">Reach out to our support team for personalized help.</p>
        <p class="text-gray-600">📧 support@erpcompany.com</p>
        <p class="text-gray-600">📞 +92 312 3456789</p>
        <p class="text-gray-600">🕒 Mon - Fri | 9:00 AM - 5:00 PM</p>
    </div>
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

</body>
</html>

@endsection
