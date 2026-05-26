<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ItunesService
{
    public function searchByLetter(string $letter)
    {
        $response = Http::get('https://itunes.apple.com/search', [
            'term' => $letter.' song', 'entity' => 'song', 'limit' => 50]);

        $results = $response->json()['results'] ?? [];

        $filtered = collect($results)->filter(function ($song) use ($letter) {
            return isset($song['trackName']) && strtolower($song['trackName'][0]) === strtolower($letter);
        })
            ->take(10);

        return $filtered->values()->toArray();
    }
}
