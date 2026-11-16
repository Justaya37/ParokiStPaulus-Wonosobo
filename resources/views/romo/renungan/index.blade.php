@extends('layouts.dashboard')

@section('title', 'Kerasulan Gembala: Renungan & Sapaan')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Renungan & Sapaan Gembala</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Tulis, sunting, dan terbitkan sapaan rohani dan refleksi Sabda untuk umat Paroki Santo Paulus Wonosobo.
        </p>
    </div>
    <a href="{{ route('romo.renungan.create') }}" class="btn-paroki btn-primary">
        <i class="fa-solid fa-pen-nib"></i> Tulis Renungan Baru
    </a>
</div>

<!-- Tabel Renungan -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Judul Renungan</th>
                    <th>Ayat Bacaan</th>
                    <th>Tanggal Renungan</th>
                    <th>Status</th>
                    <th>Pembaca</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($renungans as $r)
                    <tr>
                        <td>
                            <strong>{{ $r->judul }}</strong>
                            <div style="font-size: 0.775rem; color: var(--color-text-secondary);">
                                Penulis: {{ $r->author->name ?? 'Romo Paroki' }}
                            </div>
                        </td>
                        <td>
                            @if($r->ayat_bacaan)
                                <span class="badge-paroki badge-utama">{{ $r->ayat_bacaan }}</span>
                            @else
                                <span style="color: var(--color-text-secondary);">-</span>
                            @endif
                        </td>
                        <td>{{ $r->tanggal_renungan ? $r->tanggal_renungan->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($r->status === 'published')
                                <span class="badge-paroki badge-published">Published</span>
                            @else
                                <span class="badge-paroki badge-draft">Draft</span>
                            @endif
                        </td>
                        <td>{{ number_format($r->view_count) }} kali</td>
                        <td style="text-align: right;">
                            <a href="{{ route('romo.renungan.edit', $r->id) }}" class="btn-paroki btn-secondary btn-sm" title="Edit Renungan">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('romo.renungan.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Hapus naskah renungan ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada naskah renungan yang ditulis. Klik tombol "Tulis Renungan Baru".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $renungans->links() }}
</div>
@endsection

