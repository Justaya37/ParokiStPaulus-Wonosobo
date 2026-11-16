@extends('layouts.dashboard')

@section('title', 'Manajemen Pengguna Sistem')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Manajemen Akun Pengguna</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola akun pengelola sistem: Admin Sekretariat, Romo Paroki, dan Tim Komsos / OMK.
        </p>
    </div>
    <button class="btn-paroki btn-primary" onclick="document.getElementById('modalTambahUser').style.display='flex'">
        <i class="fa-solid fa-user-plus"></i> Tambah Pengguna Baru
    </button>
</div>

<!-- Tabel Pengguna -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Alamat Email</th>
                    <th>Peran (Role)</th>
                    <th>No. Telepon / WA</th>
                    <th>Status Akun</th>
                    <th>Terdaftar Sejak</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>
                            <strong>{{ $u->name }}</strong>
                            @if($u->id === auth()->id())
                                <span class="badge-paroki badge-stasi" style="font-size: 0.65rem; margin-left: 0.35rem;">Akun Anda</span>
                            @endif
                        </td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge-paroki badge-utama">{{ $u->role->display_name ?? '-' }}</span>
                        </td>
                        <td>{{ $u->no_hp ?? '-' }}</td>
                        <td>
                            @if($u->status_aktif)
                                <span class="badge-paroki badge-published">Aktif</span>
                            @else
                                <span class="badge-paroki badge-draft">Dinonaktifkan</span>
                            @endif
                        </td>
                        <td>{{ $u->created_at ? $u->created_at->format('d/m/Y') : '-' }}</td>
                        <td style="text-align: right;">
                            @if($u->id !== auth()->id())
                                <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-paroki btn-secondary btn-sm" title="Ubah Status Aktif/Non-aktif">
                                        <i class="fa-solid fa-power-off"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $users->links() }}
</div>

<!-- Modal Tambah Pengguna -->
<div id="modalTambahUser" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; align-items: center; justify-content: center; padding: 1rem;">
    <div class="card-paroki" style="width: 100%; max-width: 500px; max-height: 90vh; overflow-y: auto; padding: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.35rem; margin: 0; color: var(--color-primary);">Tambah Akun Pengguna</h3>
            <button onclick="document.getElementById('modalTambahUser').style.display='none'" style="background: none; border: none; font-size: 1.25rem; cursor: pointer; color: var(--color-text-secondary);">&times;</button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="role_id">Peran Otorisasi (Role) *</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">-- Pilih Peran Pengguna --</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->display_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap Pengguna *</label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="Contoh: Tim Sekretariat Paroki">
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email Login *</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="nama@parokiwonosobo.org">
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi Awal * (Minimal 8 Karakter)</label>
                <input type="password" name="password" id="password" class="form-control" required minlength="8" placeholder="••••••••">
            </div>

            <div class="form-group">
                <label class="form-label" for="no_hp">Nomor HP / WhatsApp</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="status_aktif" value="1" checked>
                    <span style="font-size: 0.875rem; font-weight: 600;">Status Akun Aktif (Dapat Login)</span>
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" class="btn-paroki btn-secondary" onclick="document.getElementById('modalTambahUser').style.display='none'">Batal</button>
                <button type="submit" class="btn-paroki btn-primary">Daftarkan Pengguna</button>
            </div>
        </form>
    </div>
</div>
@endsection

