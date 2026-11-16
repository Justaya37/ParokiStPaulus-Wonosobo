@extends('layouts.dashboard')

@section('title', 'Kelola Berita Paroki')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Berita & Warta Paroki</h1>
        <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
            Kelola publikasi artikel berita, liputan pastoral, dan warta OMK Paroki Santo Paulus Wonosobo.
        </p>
    </div>
    <a href="{{ route('komsos.berita.create') }}" class="btn-paroki btn-primary">
        <i class="fa-solid fa-pen-nib"></i> Tulis Berita Baru
    </a>
</div>

<!-- Tabel Berita -->
<div class="card-paroki" style="padding: 0; overflow: hidden;">
    <div class="table-responsive">
        <table class="table-paroki">
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Tanggal Terbit</th>
                    <th>Status</th>
                    <th>Pembaca</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $b)
                    <tr>
                        <td>
                            <strong>{{ $b->judul }}</strong>
                        </td>
                        <td>
                            <span class="badge-paroki badge-utama">{{ $b->kategori->nama_kategori ?? '-' }}</span>
                        </td>
                        <td>{{ $b->author->name ?? 'Tim Komsos' }}</td>
                        <td>{{ $b->published_at ? $b->published_at->format('d/m/Y') : '-' }}</td>
                        <td>
                            @if($b->status === 'published')
                                <span class="badge-paroki badge-published">Published</span>
                            @else
                                <span class="badge-paroki badge-draft">Draft</span>
                            @endif
                        </td>
                        <td>{{ number_format($b->view_count) }} kali</td>
                        <td style="text-align: right;">
                            <a href="{{ route('komsos.berita.edit', $b->id) }}" class="btn-paroki btn-secondary btn-sm" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('komsos.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus artikel berita ini?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-paroki btn-danger btn-sm" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2.5rem; color: var(--color-text-secondary);">
                            Belum ada artikel berita yang ditulis. Klik tombol "Tulis Berita Baru".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem;">
    {{ $beritas->links() }}
</div>
@endsection

