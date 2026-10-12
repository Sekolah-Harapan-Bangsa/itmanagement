<?php

namespace App\Http\Controllers;

use App\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratExport;
use App\Imports\SuratImport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $query = Surat::query();

        if ($request->has('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%')
                ->orWhere('nomor_surat', 'like', '%' . $request->q . '%')
                ->orWhere('keterangan', 'like', '%' . $request->q . '%');
        }

        $surats = $query->latest()->get();
        $generatedNomor = $this->generateNomorSurat(); // Tambahan ini

        return view('surat.index', compact('surats', 'generatedNomor'));
    }

    public function generateNomorSurat()
    {
        $year = Carbon::now()->format('Y'); // Ambil tahun saja, contoh: 2025

        $countThisYear = Surat::whereYear('created_at', $year)->count();
        $nextNumber = str_pad($countThisYear + 1, 4, '0', STR_PAD_LEFT);

        return "SURAT/SHB4/IT/{$year}/{$nextNumber}";
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'nama' => 'required',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('surat', 'public');
        }

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'nama' => $request->nama,
            'foto' => $imagePath,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required',
            'nama' => 'required',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
        ]);

        $imagePath = $surat->foto;

        if ($request->hasFile('foto')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('foto')->store('surat', 'public');
        }

        $surat->update([
            'nomor_surat' => $request->nomor_surat,
            'nama' => $request->nama,
            'foto' => $imagePath,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data berhasil diupdate.');
    }

    public function showApi($id)
    {
        $surat = Surat::findOrFail($id);

        return response()->json([
            'data' => $surat,
        ]);
    }

    public function export(Request $request)
    {
        $ext = $request->extension;

        if (!in_array($ext, ['xlsx', 'xls', 'csv', 'pdf'])) {
            return back()->with('error', 'Ekstensi tidak valid!');
        }

        $year = now()->year;
        $fileName = "data-surat-it-shb4-{$year}.{$ext}";

        if ($ext === 'pdf') {
            $surats = Surat::all();
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('surat.modal.export_pdf', compact('surats'));
            return $pdf->download($fileName);
        }

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SuratExport, $fileName);
    }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(new SuratImport, $request->file('file'));

        return redirect()->route('surat.index')->with('success', 'Data berhasil diimport.');
    }
}
