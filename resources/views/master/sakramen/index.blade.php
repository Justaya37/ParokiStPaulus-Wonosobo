@extends('layouts.dashboard')

@section('title', 'Data Master: Informasi 7 Sakramen')

@section('content')
<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.75rem; margin-bottom: 0.25rem;">Data Master: Panduan Informasi 7 Sakramen</h1>
    <p style="color: var(--color-text-secondary); margin: 0; font-size: 0.875rem;">
        Kelola katekese, persyaratan berkas fisik, dan alur prosedur tatap muka pelayanan 7 sakramen gereja (Bebas formulir online).
    </p>
</div>

<div style="display: flex; flex-direction: column; gap: 2rem;">
    @foreach($sakramens as $sk)
        <div class="card-paroki" style="border-left: 4px solid var(--color-primary);">
            <form action="{{ route('master.sakramen.update', $sk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <span class="badge-paroki badge-utama" style="font-size: 0.85rem;">Sakramen #{{ $sk->urutan }}</span>
                    <button type="submit" class="btn-paroki btn-secondary btn-sm">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan {{ $sk->nama_sakramen }}
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Sakramen *</label>
                    <input type="text" name="nama_sakramen" class="form-control" value="{{ $sk->nama_sakramen }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Pengantar Katekese & Teologis *</label>
                    <textarea name="deskripsi_teologis" class="form-control" rows="2" required>{{ $sk->deskripsi_teologis }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group">
                        <label class="form-label">Persyaratan Berkas Fisik Tatap Muka *</label>
                        <textarea name="persyaratan" class="form-control" rows="5" required>{{ $sk->persyaratan }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Prosedur & Alur Pelayanan di Sekretariat *</label>
                        <textarea name="prosedur_pelayanan" class="form-control" rows="5" required>{{ $sk->prosedur_pelayanan }}</textarea>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Jadwal Pelaksanaan Rutin</label>
                        <input type="text" name="jadwal_pelayanan_rutin" class="form-control" value="{{ $sk->jadwal_pelayanan_rutin }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Kontak Layanan Pastoral</label>
                        <input type="text" name="kontak_layanan" class="form-control" value="{{ $sk->kontak_layanan }}">
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>
@endsection

