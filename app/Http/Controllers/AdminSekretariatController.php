<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\AuditLog;
use App\Models\JadwalEkaristi;
use App\Models\JadwalPetugasLiturgi;
use App\Models\Lingkungan;
use App\Models\LiturgiPeran;
use App\Models\Role;
use App\Models\Stasi;
use App\Models\User;
use App\Models\WartaParoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSekretariatController extends Controller
{
    // ==========================================
    // 1. JADWAL EKARISTI
    // ==========================================
    public function jadwalIndex()
    {
        $jadwals = JadwalEkaristi::with('stasi')->latest()->paginate(15);
        $stasis = Stasi::orderBy('nama_stasi', 'asc')->get();
        return view('admin.jadwal.index', compact('jadwals', 'stasis'));
    }

    public function jadwalStore(Request $request)
    {
        $data = $request->validate([
            'nama_perayaan' => 'required|string|max:150',
            'tipe_perayaan' => 'required|in:harian,mingguan,hari_raya,khusus',
            'stasi_id' => 'nullable|exists:stasis,id',
            'lokasi_keterangan' => 'nullable|string|max:150',
            'hari' => 'nullable|string|max:20',
            'tanggal' => 'nullable|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'bahasa' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'is_aktif' => 'boolean',
        ]);

        $data['is_aktif'] = $request->has('is_aktif');
        $data['created_by'] = auth()->id();

        $jadwal = JadwalEkaristi::create($data);

        AuditLog::log('CREATE', 'JadwalEkaristi', $jadwal->id, null, $jadwal->toArray());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Ekaristi berhasil ditambahkan.');
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = JadwalEkaristi::findOrFail($id);
        $oldData = $jadwal->toArray();

        $data = $request->validate([
            'nama_perayaan' => 'required|string|max:150',
            'tipe_perayaan' => 'required|in:harian,mingguan,hari_raya,khusus',
            'stasi_id' => 'nullable|exists:stasis,id',
            'lokasi_keterangan' => 'nullable|string|max:150',
            'hari' => 'nullable|string|max:20',
            'tanggal' => 'nullable|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'nullable',
            'bahasa' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $data['is_aktif'] = $request->has('is_aktif');
        $jadwal->update($data);

        AuditLog::log('UPDATE', 'JadwalEkaristi', $jadwal->id, $oldData, $jadwal->toArray());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Ekaristi berhasil diperbarui.');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalEkaristi::findOrFail($id);
        $old = $jadwal->toArray();
        $jadwal->delete();

        AuditLog::log('DELETE', 'JadwalEkaristi', $id, $old, null);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Ekaristi berhasil dihapus.');
    }

    // ==========================================
    // 2. PETUGAS LITURGI
    // ==========================================
    public function petugasIndex()
    {
        $petugas = JadwalPetugasLiturgi::with(['jadwalEkaristi.stasi', 'peran', 'lingkungan'])
            ->latest()
            ->paginate(15);
        $jadwals = JadwalEkaristi::aktif()->get();
        $perans = LiturgiPeran::orderBy('nama_peran', 'asc')->get();
        $lingkungans = Lingkungan::orderBy('nomor_lingkungan', 'asc')->get();

        return view('admin.petugas.index', compact('petugas', 'jadwals', 'perans', 'lingkungans'));
    }

    public function petugasStore(Request $request)
    {
        $data = $request->validate([
            'jadwal_ekaristi_id' => 'required|exists:jadwal_ekaristis,id',
            'liturgi_peran_id' => 'required|exists:liturgi_perans,id',
            'lingkungan_id' => 'nullable|exists:lingkungans,id',
            'nama_petugas' => 'required|string|max:150',
            'kontak' => 'nullable|string|max:50',
            'catatan' => 'nullable|string',
        ]);

        $item = JadwalPetugasLiturgi::create($data);
        AuditLog::log('CREATE', 'JadwalPetugasLiturgi', $item->id, null, $item->toArray());

        return redirect()->route('admin.petugas.index')->with('success', 'Penugasan petugas liturgi berhasil disimpan.');
    }

    public function petugasDestroy($id)
    {
        $item = JadwalPetugasLiturgi::findOrFail($id);
        $old = $item->toArray();
        $item->delete();

        AuditLog::log('DELETE', 'JadwalPetugasLiturgi', $id, $old, null);
        return redirect()->route('admin.petugas.index')->with('success', 'Penugasan petugas liturgi berhasil dihapus.');
    }

    // ==========================================
    // 3. AGENDA KEGIATAN
    // ==========================================
    public function agendaIndex()
    {
        $agendas = AgendaKegiatan::latest('tanggal_mulai')->paginate(15);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function agendaStore(Request $request)
    {
        $data = $request->validate([
            'nama_kegiatan' => 'required|string|max:200',
            'kategori_kegiatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable',
            'waktu_selesai' => 'nullable',
            'lokasi' => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'penyelenggara' => 'required|string|max:150',
            'kontak_person' => 'nullable|string|max:100',
        ]);

        $data['slug'] = Str::slug($data['nama_kegiatan']) . '-' . Str::random(5);
        $data['created_by'] = auth()->id();
        $data['is_aktif'] = $request->has('is_aktif');

        $agenda = AgendaKegiatan::create($data);
        AuditLog::log('CREATE', 'AgendaKegiatan', $agenda->id, null, $agenda->toArray());

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil dibuat.');
    }

    public function agendaDestroy($id)
    {
        $agenda = AgendaKegiatan::findOrFail($id);
        $old = $agenda->toArray();
        $agenda->delete();

        AuditLog::log('DELETE', 'AgendaKegiatan', $id, $old, null);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda kegiatan berhasil dihapus.');
    }

    // ==========================================
    // 4. WARTA PAROKI
    // ==========================================
    public function wartaIndex()
    {
        $wartas = WartaParoki::latest('tanggal_terbit')->paginate(15);
        return view('admin.warta.index', compact('wartas'));
    }

    public function wartaStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'edisi' => 'required|string|max:100',
            'tanggal_terbit' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_pdf' => 'required|file|mimes:pdf|max:15360', // Max 15MB
            'status' => 'required|in:draft,published',
        ]);

        $filePath = $request->file('file_pdf')->store('warta-paroki', 'public');
        $fileSize = $request->file('file_pdf')->getSize();

        $warta = WartaParoki::create([
            'user_id' => auth()->id(),
            'judul' => $data['judul'],
            'edisi' => $data['edisi'],
            'tanggal_terbit' => $data['tanggal_terbit'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'file_path' => $filePath,
            'file_size_bytes' => $fileSize,
            'status' => $data['status'],
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        AuditLog::log('CREATE', 'WartaParoki', $warta->id, null, $warta->toArray());

        return redirect()->route('admin.warta.index')->with('success', 'Warta Paroki berhasil diunggah.');
    }

    public function wartaDestroy($id)
    {
        $warta = WartaParoki::findOrFail($id);
        $old = $warta->toArray();

        if (Storage::disk('public')->exists($warta->file_path)) {
            Storage::disk('public')->delete($warta->file_path);
        }

        $warta->delete();
        AuditLog::log('DELETE', 'WartaParoki', $id, $old, null);

        return redirect()->route('admin.warta.index')->with('success', 'Warta Paroki berhasil dihapus.');
    }

    // ==========================================
    // 5. MANAJEMEN PENGGUNA (USERS)
    // ==========================================
    public function usersIndex()
    {
        $users = User::with('role')->paginate(15);
        $roles = Role::where('name', '!=', 'guest')->get();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function usersStore(Request $request)
    {
        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8',
            'no_hp' => 'nullable|string|max:30',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['status_aktif'] = $request->has('status_aktif');

        $user = User::create($data);
        AuditLog::log('CREATE', 'User', $user->id, null, ['name' => $user->name, 'email' => $user->email, 'role_id' => $user->role_id]);

        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil didaftarkan.');
    }

    public function usersToggleStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->status_aktif = !$user->status_aktif;
        $user->save();

        AuditLog::log('UPDATE', 'User', $user->id, null, ['status_aktif' => $user->status_aktif]);

        return redirect()->route('admin.users.index')->with('success', 'Status akun pengguna berhasil diubah.');
    }

    // ==========================================
    // 6. AUDIT LOGS
    // ==========================================
    public function auditLogs()
    {
        $logs = AuditLog::with('user')->latest('created_at')->paginate(25);
        return view('admin.audit_logs', compact('logs'));
    }
}

