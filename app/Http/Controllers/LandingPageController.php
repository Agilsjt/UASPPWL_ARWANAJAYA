<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function showLandingPage()
    {
        $employees = Employee::with('skills')->get();

        // Ambil perusahaan yang aktif (kalau hanya satu, bisa pakai first())
        $perusahaans = Perusahaan::where('status', 'aktif')->first();

        return view('welcome', [
            'title' => $perusahaan->nama_perusahaan ?? 'Arwana Jaya',
            'employees' => $employees,
            'perusahaans' => $perusahaans,
        ]);
    }
}