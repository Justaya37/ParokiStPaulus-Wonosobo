<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Berita;
use App\Models\GaleriAlbum;
use App\Models\GaleriFoto;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TimKomsosController extends Controller
{
    // ==========================================
    // 1. BERITA PAROKI
    // ==========================================
    public function beritaIndex()
    {
        $beritas = Berita::with('kategori', 'author')->latest()->paginate(15);
        return view('komsos.berita.index', compact('beritas'));
    }

    public function beritaCreate()
    {
        $kategoris = KategoriBerita::orderBy('nama_kategori', 'asc')->get();
        return view('komsos.berita.create', compact('kategoris'));
    }

    public function beritaStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'caption_gambar' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'gambar_sampul' => 'nullable|image|max:4096', // Max 4MB
        ]);

        $data['slug'] = Str::slug($data['judul']) . '-' . Str::random(5);
        $data['user_id'] = auth()->id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        if ($request->hasFile('gambar_sampul')) {
            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('berita', 'public');
        }

        $berita = Berita::create($data);
        AuditLog::log('CREATE', 'Berita', $berita->id, null, $berita->toArray());

        return redirect()->route('komsos.berita.index')->with('success', 'Warta berita berhasil disimpan.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoris = KategoriBerita::orderBy('nama_kategori', 'asc')->get();
        return view('komsos.berita.edit', compact('berita', 'kategoris'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $old = $berita->toArray();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_berita_id' => 'required|exists:kategori_beritas,id',
            'ringkasan' => 'nullable|string',
            'isi' => 'required|string',
            'caption_gambar' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'gambar_sampul' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('gambar_sampul')) {
            if ($berita->gambar_sampul && Storage::disk('public')->exists($berita->gambar_sampul)) {
                Storage::disk('public')->delete($berita->gambar_sampul);
            }
            $data['gambar_sampul'] = $request->file('gambar_sampul')->store('berita', 'public');
        }

        if ($data['status'] === 'published' && !$berita->published_at) {
            $data['published_at'] = now();
        }

        $berita->update($data);
        AuditLog::log('UPDATE', 'Berita', $berita->id, $old, $berita->toArray());

        return redirect()->route('komsos.berita.index')->with('success', 'Warta berita berhasil diperbarui.');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        $old = $berita->toArray();
        $berita->delete();

        AuditLog::log('DELETE', 'Berita', $id, $old, null);
        return redirect()->route('komsos.berita.index')->with('success', 'Warta berita berhasil dihapus.');
    }

    // ==========================================
    // 2. KATEGORI BERITA
    // ==========================================
    public function kategoriIndex()
    {
        $kategoris = KategoriBerita::withCount('beritas')->orderBy('urutan', 'asc')->get();
        return view('komsos.kategori.index', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $data['slug'] = Str::slug($data['nama_kategori']);

        KategoriBerita::create($data);
        return redirect()->route('komsos.kategori.index')->with('success', 'Kategori warta berhasil ditambahkan.');
    }

    public function kategoriDestroy($id)
    {
        $kategori = KategoriBerita::withCount('beritas')->findOrFail($id);
        if ($kategori->beritas_count > 0) {
            return redirect()->back()->with('error', 'Kategori ini tidak dapat dihapus karena masih menaungi ' . $kategori->beritas_count . ' artikel warta.');
        }

        $kategori->delete();
        return redirect()->route('komsos.kategori.index')->with('success', 'Kategori warta berhasil dihapus.');
    }

    // ==========================================
    // 3. GALERI & FOTO
    // ==========================================
    public function galeriIndex()
    {
        $albums = GaleriAlbum::withCount('fotos')->latest('tanggal_kegiatan')->paginate(15);
        return view('komsos.galeri.index', compact('albums'));
    }

    public function galeriStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:200',
            'tanggal_kegiatan' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $data['slug'] = Str::slug($data['judul']) . '-' . Str::random(5);
        $data['user_id'] = auth()->id();

        $album = GaleriAlbum::create($data);
        return redirect()->route('komsos.galeri.show', $album->id)->with('success', 'Album foto berhasil dibuat. Silakan tambahkan foto-foto kegiatan.');
    }

    public function galeriShow($id)
    {
        $album = GaleriAlbum::with('fotos')->findOrFail($id);
        return view('komsos.galeri.show', compact('album'));
    }

    public function galeriFotoUpload(Request $request, $albumId)
    {
        $album = GaleriAlbum::findOrFail($albumId);

        $request->validate([
            'foto' => 'required|image|max:8192', // Max 8MB
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        $album->fotos()->create([
            'file_path' => $path,
            'caption' => $request->caption,
            'urutan' => $album->fotos()->count() + 1,
        ]);

        return redirect()->route('komsos.galeri.show', $album->id)->with('success', 'Foto berhasil diunggah ke album.');
    }

    public function galeriFotoDestroy($fotoId)
    {
        $foto = GaleriFoto::findOrFail($fotoId);
        $albumId = $foto->galeri_album_id;

        if (Storage::disk('public')->exists($foto->file_path)) {
            Storage::disk('public')->delete($foto->file_path);
        }

        $foto->delete();
        return redirect()->route('komsos.galeri.show', $albumId)->with('success', 'Foto berhasil dihapus.');
    }
}

