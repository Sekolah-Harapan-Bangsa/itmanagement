<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Imports\TaskImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskController extends Controller
{
    // Halaman utama task (tabel)
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));
    }

    // Import dari Excel
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new TaskImport, $request->file('file'));

        return redirect()->route('tasks.index')->with('ok', 'Data berhasil diimport dari Excel.');
    }

    public function exportPdf()
    {
        $tasks = Task::latest()->get();
    
        // Panggil view dari folder modal
        $pdf = Pdf::loadView('task.modal.export_pdf', compact('tasks'))
                  ->setPaper('A4', 'landscape');
    
        return $pdf->download('data-task.pdf');
    }
    
    public function print()
    {
        $tasks = Task::latest()->get();
    
        $pdf = Pdf::loadView('task.modal.export_pdf', compact('tasks'))
                  ->setPaper('A4', 'landscape');
    
        return $pdf->stream('data-task.pdf');
    }

}
