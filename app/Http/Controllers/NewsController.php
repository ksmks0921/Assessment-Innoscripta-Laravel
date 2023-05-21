<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $apiKey = 'a21f5e438adf4a6ca54de374212197e7';
        $endpoint = 'https://newsapi.org/v2/top-headlines';
        $country = 'us'; // Specify the desired country
        $category = 'general'; // Specify the desired category

        $client = new Client();

        try {
            $response = $client->get($endpoint, [
                'query' => [
                    'apiKey' => $apiKey,
                    'country' => $country,
                    'category' => $category,
                ],
            ]);

            $news = json_decode($response->getBody(), true);

            return response()->json($news);
        } catch (\Exception $e) {
            // Handle the error gracefully
            return response()->json(['error' => 'Failed to fetch news'], 500);
        }
    }
    
    public function getNYTimes()
    {
        $apiKey = 'Hv1p3h03ZIo1BHpmIGGUYAwuoGp0setm'; // Replace with your New York Times API key

        $client = new Client();

        try {
            $response = $client->get("https://api.nytimes.com/svc/topstories/v2/home.json?api-key={$apiKey}");
            $data = json_decode($response->getBody(), true);

            // Process the retrieved news data
            // ...

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch news.'], 500);
        }
    }
    public function getGuardianNews()
    {
        $apiKey = 'f7b327cb-95a2-4af8-87c9-b44c3baa5325'; // Replace with your The Guardian API key
        $searchTerm = 'football';
        $client = new Client();

        try {
            $response = $client->get("https://content.guardianapis.com/search?q={$searchTerm}&api-key={$apiKey}");
            $data = json_decode($response->getBody(), true);

            // Process the retrieved news data
            // ...

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch news.'], 500);
        }
    }
}
