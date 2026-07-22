<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoKebaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class VideoKebaikanController extends Controller
{
    public function index(): View
    {
        $videoKebaikan = VideoKebaikan::orderByDesc('created_at')->get();

        return view('Admin.video-kebaikan.index', compact('videoKebaikan'));
    }

    public function create(): View
    {
        return view('Admin.video-kebaikan.create');
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

        VideoKebaikan::create($resolved);

        return redirect()->route('admin.videokebaikan.index')->with('success', 'Video kebaikan berhasil ditambahkan.');
    }

    public function show(VideoKebaikan $videokebaikan): RedirectResponse
    {
        return redirect()->route('admin.videokebaikan.edit', $videokebaikan);
    }

    public function edit(VideoKebaikan $videokebaikan): View
    {
        return view('Admin.video-kebaikan.edit', ['video' => $videokebaikan]);
    }

    public function update(Request $request, VideoKebaikan $videokebaikan): RedirectResponse
    {
        $validated = $request->validate([
            'link' => ['required', 'url', 'max:500'],
        ], [
            'link.required' => 'Link YouTube wajib diisi.',
            'link.url'      => 'Link harus berupa URL yang valid (contoh: https://youtube.com/watch?v=...).',
        ]);

        // Cuma fetch ulang ke YouTube kalau link-nya beneran berubah.
        if ($validated['link'] !== $videokebaikan->link) {
            $resolved = $this->resolveYoutube($validated['link']);

            if (! $resolved) {
                return back()->withInput()->withErrors([
                    'link' => 'Link YouTube tidak valid atau videonya tidak ditemukan.',
                ]);
            }

            $videokebaikan->update($resolved);
        }

        return redirect()->route('admin.videokebaikan.index')->with('success', 'Video kebaikan berhasil diperbarui.');
    }

    public function destroy(VideoKebaikan $videokebaikan): RedirectResponse
    {
        $videokebaikan->delete();

        return redirect()->route('admin.videokebaikan.index')->with('success', 'Video kebaikan berhasil dihapus.');
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
            'title'         => $data['title'] ?? 'Video Kebaikan',
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