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
}
