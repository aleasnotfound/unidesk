<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // ============================== Section Mahasiswa ==============================

    public function index()
    {
        // Tampilan Beranda Laporan
        // 1. Tampil jika laporan dibuat kurang dari 3 jam
        // 2. Tampil jika status laporan diupdate admin kurang dari 24 jam
        
        $reports = Report::where('created_at', '>=', now()->subHours(3))
            ->orWhere(function($query) {
                $query->where('updated_at', '>=', now()->subHours(24))
                      ->whereColumn('updated_at', '>', 'created_at');
            })
            ->latest()
            ->get();

        return view('mahasiswa_form', compact('reports'));
    }

    // Simpan Laporan
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas' => 'required',
            'keluhan' => 'required',
            'jurusan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:20480', // Validasi foto
        ]);

        $data = $request->all();

        // Cek Anonim
        if ($request->has('is_anonymous')) {
            $data['is_anonymous'] = true;
            $data['nama_mahasiswa'] = 'Dirahasiakan';
            $data['nim'] = '-';
        } else {
            $data['is_anonymous'] = false;
        }

        // Upload Foto 
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke folder 'public' (storage/app/public/bukti_laporan)
            $file->storeAs('bukti_laporan', $filename, 'public');
            
            // Simpan path ke database
            $data['foto'] = 'bukti_laporan/' . $filename;
        }

        Report::create($data);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim! Terima kasih atas kontribusi Anda.');
    }

    // ============================== Section Admin ==============================

    // Login Admin
    public function showLogin() {
        return view('admin_login');
    }

    // Login
    public function processLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    // Dashboard Tabel Admin
    public function dashboard()
    {
        $reports = Report::latest()->get();
        return view('admin_dashboard', compact('reports'));
    }

    // Update Status Laporan
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    // Hapus Laporan
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        
        // Hapus foto (jika ada)
        if($report->foto) {
            Storage::delete('public/' . $report->foto);
        }
        
        $report->delete();
        return redirect()->back()->with('success', 'Laporan dihapus.');
    }
}