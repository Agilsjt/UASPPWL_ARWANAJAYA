<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Skill;
use App\Models\User;
use App\Models\Layanan;

class DashboardController extends Controller
{


    public function index()
    {
        $employeeCount = Employee::count();
        $skillCount = Skill::count();
        $userCount = User::count();
        $layananCount = Layanan::count();

        return view('dashboard', compact('employeeCount', 'skillCount', 'userCount', 'layananCount'));
    }
}