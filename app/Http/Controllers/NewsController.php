<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Api;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
      
    

    public function displayNews(Request $request)
    {
        $searchKeyword = $request->query('q');        
        $source = $request->query('sourceId') == "" ? config('app.default_news_source_id') : $request->query('sourceId');
        $category = $request->query('category') == "" ? config('app.default_news_category') : $request->query('category');    
        $fromDate = $request->query('from');  
        $toDate = $request->query('to'); 

        $apiModel = new Api();
        if($source == 'nytimes') {
            $response['searchKey'] = $searchKeyword; 
            $response['news'] = $apiModel->fetchNewYorkTimesNewsFromSource($searchKeyword, $category, $fromDate, $toDate); 
                        
        } else if ($source == 'guardian') {
            $response['news'] = $apiModel->fetchGuardianNewsFromSource($searchKeyword, $category, $fromDate, $toDate);   
                    
        } else if ($source == 'news-api') {
            $response['searchKey'] = $searchKeyword; 
            $response['news'] = $apiModel->fetchNewsFromSource($searchKeyword, $category, $fromDate, $toDate);           
        }
      

        // $response['newsSources'] = $this->fetchAllNewsSources();
        return response()->json( $response);
      
    }
   
    public function fetchAllNewsSources()
    {
        $response = Cache::remember('allNewsSources', 22 * 60, function () {
            $api = new Api;
            return $api->getAllSources();
        });
        return $response;
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
