@extends('layout')

@section('content')

<!-- Hero Section -->
<section class="bg-blue-900 text-white py-16 rounded mb-6">
    <div class="text-center max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">SmartStaff ERP System</h1>
        <p class="text-lg text-gray-200 mb-6">Your complete HR, Payroll, Attendance, and Leave Management Solution</p>
        <a href="/login" class="bg-white text-blue-900 font-semibold px-6 py-3 rounded shadow hover:bg-gray-200">Login Now</a>
    </div>
</section>

<!-- Modules/Features -->
<section class="mb-10">
    <h2 class="text-3xl font-bold text-center mb-8">Key Modules</h2>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">👥 Employee Management</h3>
            <p>Maintain employee profiles, contact info, roles, and job history in one place.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">🕒 Attendance Tracking</h3>
            <p>Track daily attendance with timestamps and generate monthly attendance reports.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">📅 Leave Management</h3>
            <p>Submit and approve leave requests, and view leave balances and history.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">💰 Payroll Automation</h3>
            <p>Generate accurate salary slips with tax and allowance breakdown.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">📈 HR Reports</h3>
            <p>Download detailed reports for attendance, salary, leaves, and more.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2">🔐 Secure Login</h3>
            <p>Multi-role authentication for Admin, HR, and Employees with session protection.</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-gray-100 p-10 rounded-lg mb-10">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
            <h3 class="text-4xl font-bold text-blue-600">150+</h3>
            <p class="text-gray-600 mt-2">Employees Managed</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-green-600">98%</h3>
            <p class="text-gray-600 mt-2">Attendance Accuracy</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-yellow-600">12+</h3>
            <p class="text-gray-600 mt-2">Departments Handled</p>
        </div>
        <div>
            <h3 class="text-4xl font-bold text-red-500">Rs. 10M+</h3>
            <p class="text-gray-600 mt-2">Salaries Processed</p>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="mb-16">
    <h2 class="text-3xl font-bold text-center mb-10">What Our Users Say</h2>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="mb-4">“This ERP saved our HR team hours of manual work. The payroll and leave automation is superb.”</p>
            <p class="text-sm text-gray-500">– Saad, HR Manager</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="mb-4">“I love how easy the interface is. I can apply for leaves and check salary slips easily.”</p>
            <p class="text-sm text-gray-500">– Fatima, Employee</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <p class="mb-4">“Best thing is the role-based access. Admins and employees have their own dashboards.”</p>
            <p class="text-sm text-gray-500">– Mr. Imran, CEO</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-blue-50 p-10 rounded-lg">
    <h2 class="text-3xl font-bold text-center mb-8">Need Help or Want a Demo?</h2>
    <div class="max-w-xl mx-auto">
        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block mb-1">Your Message</label>
                <textarea name="message" rows="4" class="w-full px-4 py-2 border rounded"></textarea>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">Send</button>
        </form>
    </div>
</section>

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
