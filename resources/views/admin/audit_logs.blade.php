@extends('layouts.dashboard')

@section('title', 'Catatan Audit Sistem (Audit Log)')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Catatan Audit Sistem (Audit Log)</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Rekam jejak seluruh mutasi data, pembuatan, pembaruan, dan penghapusan data penting paroki.
    </p>
</div>

<!-- Tabel Log -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Waktu Kejadian</th>
                    <th>Aksi</th>
                    <th>Entitas Modul</th>
                    <th>ID Record</th>
                    <th>Pengguna Pelaku</th>
                    <th>Alamat IP</th>
                    <th>Detail Perubahan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $l)
                    <tr>
                        <td style="font-size: 0.825rem; white-space: nowrap;">
                            {{ $l->created_at ? $l->created_at->format('d/m/Y H:i:s') : '-' }}
                        </td>
                        <td>
                            @php
                                $badgeClass = match($l->aksi) {
                                    'CREATE' => 'badge-published',
                                    'UPDATE' => 'badge-utama',
                                    'DELETE' => 'badge-draft',
                                    default => 'badge-stasi'
                                };
                            @endphp
                            <span class="badge-paroki {{ $badgeClass }}" style="font-size: 0.725rem;">
                                {{ $l->aksi }}
                            </span>
                        </td>
                        <td><strong>{{ $l->entitas }}</strong></td>
                        <td>{{ $l->entitas_id ?? '-' }}</td>
                        <td>
                            <strong>{{ $l->user->name ?? 'User Dihapus' }}</strong>
                            <div style="font-size: 0.725rem; color: var(--color-text-secondary);">Role: {{ $l->role_name }}</div>
                        </td>
                        <td style="font-family: monospace; font-size: 0.8rem;">{{ $l->ip_address ?? '-' }}</td>
                        <td>
                            @if($l->data_baru)
                                <details style="cursor: pointer; font-size: 0.75rem;">
                                    <summary style="color: var(--color-secondary); font-weight: 600;">Lihat Payload Data</summary>
                                    <pre style="background: var(--color-surface); padding: 0.5rem; border-radius: var(--radius-sm); margin-top: 0.25rem; overflow-x: auto; max-width: 320px;">{{ json_encode($l->data_baru, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </details>
                            @else
                                <span style="font-size: 0.8rem; color: var(--color-text-secondary);">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada riwayat audit log yang tercatat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $logs->links() }}
</div>
@endsection

