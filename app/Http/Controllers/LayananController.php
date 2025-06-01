<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('read-layanan');

        $layanans = Layanan::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama_layanan', 'like', "%{$request->search}%")
                      ->orWhere('deskripsi', 'like', "%{$request->search}%");
            })
            ->paginate(10);

        return view('layanans.index', compact('layanans'));
    }

    public function create()
    {
        Gate::authorize('create-layanan');

        return view('layanans.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create-layanan');

        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga'        => 'required|numeric|min:0',
            'kategori'     => 'required|string|max:100',
        ]);

        $layanan = new Layanan($validated);

        if ($request->hasFile('gambar')) {
            $layanan->gambar = $this->saveImage($request);
        }

        $layanan->save();

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(Layanan $layanan)
    {
        Gate::authorize('read-layanan');

        return view('layanans.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        Gate::authorize('edit-layanan');

        return view('layanans.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        Gate::authorize('edit-layanan');

        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga'        => 'required|numeric|min:0',
            'kategori'     => 'required|string|max:100',
        ]);

        $layanan->update(
            collect($validated)->except(['gambar'])->toArray()
        );

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
                Storage::disk('public')->delete($layanan->gambar);
            }

            $layanan->gambar = $this->saveImage($request);
            $layanan->save();
        }

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        Gate::authorize('delete-layanan');

        if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        $layanan->delete();

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil dihapus.');
    }

    /**
     * Simpan gambar layanan ke penyimpanan publik.
     */
    private function saveImage(Request $request): string
    {
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('layanan', $filename, 'public');
    }
}
