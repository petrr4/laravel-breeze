<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\View\View; 
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:mahasiswas'
        ]);

        Mahasiswa::create($request->all());

        $notifications = [
            'message' => 'Data Tersimpan',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notifications);
    }

    public function update(Request $request, Mahasiswa $mahasiswa){
        $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255|unique:mahasiswas,nama,' . $mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());

        $notifications = [
            'message' => 'Data Diubah',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notifications);
    }

    public function destroy($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        $notifications = [
            'message' => 'Data Dihapus',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notifications);
    }
}