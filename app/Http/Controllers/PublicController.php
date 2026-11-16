<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use App\Models\ArsitekturFilosofi;
use App\Models\ArsitekturSimbol;
use App\Models\Berita;
use App\Models\GaleriAlbum;
use App\Models\JadwalEkaristi;
use App\Models\Lingkungan;
use App\Models\OrganisasiKategorial;
use App\Models\Pastor;
use App\Models\ProfilParoki;
use App\Models\Renungan;
use App\Models\SakramenInformasi;
use App\Models\SejarahParoki;
use App\Models\Stasi;
use App\Models\WartaParoki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index()
    {
        $profil = ProfilParoki::first();
        
        // Next upcoming mass schedules (both main church and stasi)
        $jadwalUtama = JadwalEkaristi::with('stasi')
            ->aktif()
            ->gerejaUtama()
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('waktu_mulai', 'asc')
            ->take(6)
            ->get();

        $jadwalStasi = JadwalEkaristi::with('stasi')
            ->aktif()
            ->stasi()
            ->take(6)
            ->get();

        // 3 upcoming agendas
        $agendas = AgendaKegiatan::aktif()
            ->where('tanggal_mulai', '>=', now()->toDateString())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(3)
            ->get();

        // 3 recent published news
        $beritas = Berita::with('kategori', 'author')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Latest published renungan
        $renunganTerbaru = Renungan::with('author')
            ->published()
            ->latest('published_at')
            ->first();

        // Latest published warta paroki
        $wartaTerbaru = WartaParoki::published()
            ->latest('published_at')
            ->first();

        // 3 or 6 recent published photo albums for homepage highlight
        $galeriAlbums = GaleriAlbum::with('fotos')
            ->published()
            ->latest('tanggal_kegiatan')
            ->take(6)
            ->get();

        $arsitektur = ArsitekturFilosofi::first();
        $simbolPreview = ArsitekturSimbol::orderBy('nomor_simbol', 'asc')->take(4)->get();

        return view('public.index', compact(
            'profil',
            'jadwalUtama',
            'jadwalStasi',
            'agendas',
            'beritas',
            'renunganTerbaru',
            'wartaTerbaru',
            'galeriAlbums',
            'arsitektur',
            'simbolPreview'
        ));
    }

    public function profil()
    {
        $profil = ProfilParoki::first();
        $sejarah = SejarahParoki::orderBy('urutan', 'asc')->orderBy('tahun', 'asc')->get();
        $kategorials = OrganisasiKategorial::orderBy('urutan', 'asc')->get();

        return view('public.profil', compact('profil', 'sejarah', 'kategorials'));
    }

    public function arsitektur()
    {
        $filosofi = ArsitekturFilosofi::first();
        $simbols = ArsitekturSimbol::orderBy('nomor_simbol', 'asc')->get();

        return view('public.arsitektur', compact('filosofi', 'simbols'));
    }

    public function pastor()
    {
        $pastors = Pastor::with('pelayanans')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('public.pastor', compact('pastors'));
    }

    public function lingkunganStasi()
    {
        $lingkungans = Lingkungan::orderBy('nomor_lingkungan', 'asc')->get();
        $stasis = Stasi::with('jadwalEkaristis')->get();

        return view('public.lingkungan_stasi', compact('lingkungans', 'stasis'));
    }

    public function jadwal(Request $request)
    {
        $tipe = $request->query('tipe');
        $stasiId = $request->query('stasi_id');

        $query = JadwalEkaristi::with(['stasi', 'petugasLiturgis.peran', 'petugasLiturgis.lingkungan'])
            ->aktif();

        if ($stasiId === 'utama' || (!$stasiId && $tipe === 'utama')) {
            $query->gerejaUtama();
        } elseif ($stasiId && is_numeric($stasiId)) {
            $query->where('stasi_id', $stasiId);
        }

        $jadwals = $query->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        $stasis = Stasi::orderBy('nama_stasi', 'asc')->get();

        return view('public.jadwal', compact('jadwals', 'stasis', 'stasiId'));
    }

    public function agenda()
    {
        $agendas = AgendaKegiatan::aktif()
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(9);

        return view('public.agenda', compact('agendas'));
    }

    public function agendaDetail($slug)
    {
        $agenda = AgendaKegiatan::where('slug', $slug)->firstOrFail();
        return view('public.agenda_detail', compact('agenda'));
    }

    public function berita(Request $request)
    {
        $kategoriSlug = $request->query('kategori');

        $query = Berita::with('kategori', 'author')->published();

        if ($kategoriSlug) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $kategoriSlug));
        }

        $beritas = $query->latest('published_at')->paginate(9);
        return view('public.berita', compact('beritas', 'kategoriSlug'));
    }

    public function beritaDetail($slug)
    {
        $berita = Berita::with('kategori', 'author')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $berita->increment('view_count');

        $beritaTerkait = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.berita_detail', compact('berita', 'beritaTerkait'));
    }

    public function renungan()
    {
        $renungans = Renungan::with('author')
            ->published()
            ->latest('published_at')
            ->paginate(6);

        return view('public.renungan', compact('renungans'));
    }

    public function renunganDetail($slug)
    {
        $renungan = Renungan::with('author')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $renungan->increment('view_count');

        return view('public.renungan_detail', compact('renungan'));
    }

    public function warta()
    {
        $wartas = WartaParoki::published()
            ->latest('tanggal_terbit')
            ->paginate(10);

        return view('public.warta', compact('wartas'));
    }

    public function wartaDownload($id)
    {
        $warta = WartaParoki::published()->findOrFail($id);
        $warta->increment('download_count');

        if (Storage::disk('public')->exists($warta->file_path)) {
            return Storage::disk('public')->download($warta->file_path, 'Warta-Paroki-' . $warta->edisi . '.pdf');
        }

        return redirect()->back()->with('error', 'Berkas fisik warta belum tersedia di server storage.');
    }

    public function galeri()
    {
        $albums = GaleriAlbum::with(['fotos'])
            ->published()
            ->latest('tanggal_kegiatan')
            ->paginate(9);

        return view('public.galeri', compact('albums'));
    }

    public function galeriDetail($slug)
    {
        $album = GaleriAlbum::with('fotos')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('public.galeri_detail', compact('album'));
    }

    public function sakramen()
    {
        $sakramens = SakramenInformasi::orderBy('urutan', 'asc')->get();
        return view('public.sakramen', compact('sakramens'));
    }
}

