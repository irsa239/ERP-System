@extends('layout')

@section('title', 'ERP Settings')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">ERP System Settings</h1>

    {{-- Company Info Settings --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Company Information</h2>
        <form method="POST" action="#">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="company_name" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="SmartStaff Pvt Ltd">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Company Email</label>
                    <input type="email" name="company_email" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="hr@smartstaff.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="company_phone" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="+92 300 1234567">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="company_address" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="Lahore, Pakistan">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>

    {{-- Leave Policy Settings --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Leave Policy</h2>
        <form method="POST" action="#">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Annual Leaves</label>
                    <input type="number" name="annual_leaves" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sick Leaves</label>
                    <input type="number" name="sick_leaves" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="10">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Casual Leaves</label>
                    <input type="number" name="casual_leaves" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="5">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>

    {{-- Salary Configurations --}}
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Salary Configuration</h2>
        <form method="POST" action="#">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Basic Salary %</label>
                    <input type="number" name="basic_percentage" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Allowance %</label>
                    <input type="number" name="allowance_percentage" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="30">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>

    {{-- Notification Settings --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Notifications</h2>
        <form method="POST" action="#">
            @csrf
            <div class="flex items-center mb-4">
                <input type="checkbox" name="notify_attendance" class="mr-2" checked>
                <label>Send daily attendance summary to HR</label>
            </div>
            <div class="flex items-center mb-4">
                <input type="checkbox" name="notify_leaves" class="mr-2" checked>
                <label>Notify manager when leave is applied</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="notify_salary" class="mr-2">
                <label>Notify employee on salary disbursement</label>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</div>
@endsection
