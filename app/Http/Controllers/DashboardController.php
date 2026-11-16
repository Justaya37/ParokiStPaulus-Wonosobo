<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\AuditLog;
use App\Models\Berita;
use App\Models\GaleriAlbum;
use App\Models\JadwalEkaristi;
use App\Models\Lingkungan;
use App\Models\Pastor;
use App\Models\Renungan;
use App\Models\Stasi;
use App\Models\User;
use App\Models\WartaParoki;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_jadwal' => JadwalEkaristi::aktif()->count(),
            'total_lingkungan' => Lingkungan::count(),
            'total_stasi' => Stasi::count(),
            'total_pastor' => Pastor::count(),
            'total_agenda' => AgendaKegiatan::aktif()->count(),
            'total_warta' => WartaParoki::count(),
            'total_berita' => Berita::count(),
            'total_berita_draft' => Berita::where('status', 'draft')->count(),
            'total_renungan' => Renungan::count(),
            'total_renungan_draft' => Renungan::where('status', 'draft')->count(),
            'total_galeri' => GaleriAlbum::count(),
            'total_users' => User::count(),
        ];

        $recentAudits = AuditLog::with('user')->latest('created_at')->take(5)->get();
        $recentJadwals = JadwalEkaristi::with('stasi')->aktif()->take(5)->get();
        $recentRenungans = Renungan::latest()->take(4)->get();
        $recentBeritas = Berita::latest()->take(4)->get();

        return view('dashboard.index', compact('stats', 'recentAudits', 'recentJadwals', 'recentRenungans', 'recentBeritas'));
    }
}

