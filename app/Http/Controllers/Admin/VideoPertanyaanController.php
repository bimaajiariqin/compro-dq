<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoPertanyaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class VideoPertanyaanController extends Controller
{
    public function index(): View
    {
        $videoPertanyaan = VideoPertanyaan::orderByDesc('created_at')->get();

        return view('admin.video-pertanyaan.index', compact('videoPertanyaan'));
    }

    public function create(): View
    {
        return view('admin.video-pertanyaan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'link' => ['required', 'url', 'max:500'],
        ], [
            'link.required' => 'Link YouTube wajib diisi.',
            'link.url'      => 'Link harus berupa URL yang valid (contoh: https://youtube.com/watch?v=...).',
        ]);

        $resolved = $this->resolveYoutube($validated['link']);

        if (! $resolved) {
            return back()->withInput()->withErrors([
                'link' => 'Link YouTube tidak valid atau videonya tidak ditemukan.',
            ]);
        }

        VideoPertanyaan::create($resolved);

        return redirect()->route('admin.videopertanyaan.index')->with('success', 'Video pertanyaan berhasil ditambahkan.');
    }

    public function show(VideoPertanyaan $videopertanyaan): RedirectResponse
    {
        return redirect()->route('admin.videopertanyaan.edit', $videopertanyaan);
    }

    public function edit(VideoPertanyaan $videopertanyaan): View
    {
        return view('admin.video-pertanyaan.edit', ['video' => $videopertanyaan]);
    }

    public function update(Request $request, VideoPertanyaan $videopertanyaan): RedirectResponse
    {
        $validated = $request->validate([
            'link' => ['required', 'url', 'max:500'],
        ], [
            'link.required' => 'Link YouTube wajib diisi.',
            'link.url'      => 'Link harus berupa URL yang valid (contoh: https://youtube.com/watch?v=...).',
        ]);

        // Cuma fetch ulang ke YouTube kalau link-nya beneran berubah.
        if ($validated['link'] !== $videopertanyaan->link) {
            $resolved = $this->resolveYoutube($validated['link']);

            if (! $resolved) {
                return back()->withInput()->withErrors([
                    'link' => 'Link YouTube tidak valid atau videonya tidak ditemukan.',
                ]);
            }

            $videopertanyaan->update($resolved);
        }

        return redirect()->route('admin.videopertanyaan.index')->with('success', 'Video pertanyaan berhasil diperbarui.');
    }

    public function destroy(VideoPertanyaan $videopertanyaan): RedirectResponse
    {
        $videopertanyaan->delete();

        return redirect()->route('admin.videopertanyaan.index')->with('success', 'Video pertanyaan berhasil dihapus.');
    }

    /**
     * Ambil video_id dari link, lalu isi title/channel_name/thumbnail_url
     * lewat oEmbed API YouTube. Return null kalau link-nya bukan link
     * YouTube yang valid atau videonya gak bisa diakses (private/dihapus).
     */
    private function resolveYoutube(string $link): ?array
    {
        $videoId = $this->extractYoutubeId($link);

        if (! $videoId) {
            return null;
        }

        try {
            $response = Http::timeout(5)->get('https://www.youtube.com/oembed', [
                'url'    => $link,
                'format' => 'json',
            ]);
        } catch (\Throwable $e) {
            return null;
        }

        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();

        return [
            'link'          => $link,
            'video_id'      => $videoId,
            'title'         => $data['title'] ?? 'Video Pertanyaan',
            'channel_name'  => $data['author_name'] ?? 'YouTube',
            'thumbnail_url' => $data['thumbnail_url'] ?? null,
        ];
    }

    private function extractYoutubeId(string $url): ?string
    {
        if (preg_match(
            '/(?:youtu\.be\/|(?:m\.|www\.)?youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        return null;
    }
}