<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    // Menampilkan daftar perusahaan dengan pencarian dan paginasi
    public function index(Request $request)
    {
        Gate::authorize('read-perusahaan');
        $search = $request->input('search');

        $perusahaans = Perusahaan::when($search, function ($query, $search) {
                return $query->where('nama_perusahaan', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%')
                             ->orWhere('telepon', 'like', '%' . $search . '%')
                             ->orWhere('alamat', 'like', '%' . $search . '%')
                             ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('perusahaans.index', compact('perusahaans'));
    }

    // Menampilkan form untuk membuat perusahaan baru
    public function create()
    {
        Gate::authorize('create-perusahaan');
        return view('perusahaans.create');
    }

    // Menyimpan data perusahaan baru
    public function store(Request $request)
    {
        Gate::authorize('create-perusahaan');
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'judul_deskripsi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,nonaktif',  // validasi status enum
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Perusahaan::create($data);

        return redirect()->route('perusahaans.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    // Menampilkan detail perusahaan
    public function show(Perusahaan $perusahaan)
    {
        Gate::authorize('read-perusahaan');
        return view('perusahaans.show', compact('perusahaan'));
    }

    // Menampilkan form edit perusahaan
    public function edit(Perusahaan $perusahaan)
    {
        Gate::authorize('edit-perusahaan');
        return view('perusahaans.edit', compact('perusahaan'));
    }

    // Memperbarui data perusahaan
    public function update(Request $request, Perusahaan $perusahaan)
    {
        Gate::authorize('edit-perusahaan');
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'judul_deskripsi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,nonaktif',  // validasi status enum
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($perusahaan->logo && Storage::disk('public')->exists($perusahaan->logo)) {
                Storage::disk('public')->delete($perusahaan->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $perusahaan->update($data);

        return redirect()->route('perusahaans.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    // Menghapus perusahaan
    public function destroy(Perusahaan $perusahaan)
    {
        Gate::authorize('delete-perusahaan');
        if ($perusahaan->logo && Storage::disk('public')->exists($perusahaan->logo)) {
            Storage::disk('public')->delete($perusahaan->logo);
        }

        $perusahaan->delete();

        return redirect()->route('perusahaans.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
