<?php

namespace App\Http\Controllers;

use App\Services\ItunesService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request, ItunesService $itunesService)
    {
        $user = $request->user();
        $letter = strtolower(substr($user->name, 0, 1));
        $medias = $itunesService->searchByLetter($letter);

        $formatted = collect($medias)->map(function ($media) {
            return [
                'name' => $media['trackName'] ?? null,
                'artist' => $media['artistName'] ?? null,
                'album' => $media['collectionName'] ?? null,
                'artwork' => $media['artworkUrl100'] ?? null,
                'url' => $media['trackViewUrl'] ?? null,
            ];
        });

        return response()->json([
            'user' => $user->name,
            'letter' => $letter,
            'medias' => $formatted->take(10)->values(),
        ]);
    }
}
