<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function showLandingPage()
    {
    $employees = Employee::with('skills')->get(); // relasi skills jika ada
    return view('welcome', [
        'title' => 'Arwana Jaya',
        'employees' => $employees,
    ]);
    }
}