<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CeritaPenerimaManfaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CeritaPenerimaManfaatController extends Controller
{
    protected array $kategoriOptions = CeritaPenerimaManfaat::KATEGORI;

    /**
     * Daftar cerita penerima manfaat, bisa difilter per kategori program.
     */
    public function index(Request $request)
    {
        $query = CeritaPenerimaManfaat::query()->terurut();

        if ($request->filled('kategori_program')) {
            $query->kategori($request->string('kategori_program'));
        }

        $cerita = $query->paginate(10)->withQueryString();

        return view('admin.cerita-penerima-manfaat.index', [
            'cerita' => $cerita,
            'kategoriOptions' => $this->kategoriOptions,
            'filterKategori' => $request->kategori_program,
        ]);
    }

    public function create()
    {
        return view('admin.cerita-penerima-manfaat.create', [
            'kategoriOptions' => $this->kategoriOptions,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('cerita-penerima-manfaat', 'public');
        }

        CeritaPenerimaManfaat::create($data);

        return redirect()
            ->route('admin.cerita-penerima-manfaat.index')
            ->with('success', 'Cerita penerima manfaat berhasil ditambahkan.');
    }

    public function edit(CeritaPenerimaManfaat $cerita_penerima_manfaat)
    {
        return view('admin.cerita-penerima-manfaat.edit', [
            'item' => $cerita_penerima_manfaat,
            'kategoriOptions' => $this->kategoriOptions,
        ]);
    }

    public function update(Request $request, CeritaPenerimaManfaat $cerita_penerima_manfaat)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('foto')) {
            if ($cerita_penerima_manfaat->foto) {
                Storage::disk('public')->delete($cerita_penerima_manfaat->foto);
            }
            $data['foto'] = $request->file('foto')->store('cerita-penerima-manfaat', 'public');
        }

        $cerita_penerima_manfaat->update($data);

        return redirect()
            ->route('admin.cerita-penerima-manfaat.index')
            ->with('success', 'Cerita penerima manfaat berhasil diperbarui.');
    }

    public function destroy(CeritaPenerimaManfaat $cerita_penerima_manfaat)
    {
        if ($cerita_penerima_manfaat->foto) {
            Storage::disk('public')->delete($cerita_penerima_manfaat->foto);
        }

        $cerita_penerima_manfaat->delete();

        return redirect()
            ->route('admin.cerita-penerima-manfaat.index')
            ->with('success', 'Cerita penerima manfaat berhasil dihapus.');
    }

    /**
     * Validasi input form. `foto` sengaja dibuang dari hasil akhir karena
     * file upload ditangani terpisah di store()/update() (agar file lama
     * bisa dihapus saat update, dan agar UploadedFile object tidak ikut
     * ter-mass-assign ke kolom string `foto`).
     */
    protected function validateData(Request $request): array
    {
        $validated = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:150'],
            'jabatan' => ['nullable', 'string', 'max:150'],
            'kategori_program' => ['required', 'in:' . implode(',', $this->kategoriOptions)],
            'isi_cerita' => ['required', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ])->validate();

        unset($validated['foto']);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        return $validated;
    }
}