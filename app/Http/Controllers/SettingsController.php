<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Show the settings page
    public function index()
    {
        // You can pass existing settings from database if needed
        return view('settings');
    }

    // Optional: Handle settings form submission
    public function update(Request $request)
    {
        // You can validate and save settings here
        // Example:
        // Setting::update([...]);

        return redirect()->route('settings')->with('success', 'Settings updated successfully!');
    }
}
