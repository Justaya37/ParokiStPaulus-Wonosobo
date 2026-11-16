<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Renungan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RomoParokiController extends Controller
{
    public function renunganIndex()
    {
        $renungans = Renungan::with('author')->latest('tanggal_renungan')->paginate(15);
        return view('romo.renungan.index', compact('renungans'));
    }

    public function renunganCreate()
    {
        return view('romo.renungan.create');
    }

    public function renunganStore(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'ayat_bacaan' => 'nullable|string|max:150',
            'tanggal_renungan' => 'required|date',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $data['slug'] = Str::slug($data['judul']) . '-' . Str::random(5);
        $data['user_id'] = auth()->id();
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        $renungan = Renungan::create($data);
        AuditLog::log('CREATE', 'Renungan', $renungan->id, null, $renungan->toArray());

        return redirect()->route('romo.renungan.index')->with('success', 'Naskah Renungan Gembala berhasil disimpan.');
    }

    public function renunganEdit($id)
    {
        $renungan = Renungan::findOrFail($id);
        return view('romo.renungan.edit', compact('renungan'));
    }

    public function renunganUpdate(Request $request, $id)
    {
        $renungan = Renungan::findOrFail($id);
        $old = $renungan->toArray();

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'ayat_bacaan' => 'nullable|string|max:150',
            'tanggal_renungan' => 'required|date',
            'isi' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        if ($data['status'] === 'published' && !$renungan->published_at) {
            $data['published_at'] = now();
        }

        $renungan->update($data);
        AuditLog::log('UPDATE', 'Renungan', $renungan->id, $old, $renungan->toArray());

        return redirect()->route('romo.renungan.index')->with('success', 'Naskah Renungan Gembala berhasil diperbarui.');
    }

    public function renunganDestroy($id)
    {
        $renungan = Renungan::findOrFail($id);
        $old = $renungan->toArray();
        $renungan->delete();

        AuditLog::log('DELETE', 'Renungan', $id, $old, null);
        return redirect()->route('romo.renungan.index')->with('success', 'Renungan Gembala berhasil dihapus.');
    }
}

