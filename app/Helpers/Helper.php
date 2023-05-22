<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
class Helper
{
    /**
     * @param $url_params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeNewsApiCalls($url_params)
    {
        try {
            $client = new Client();
            $apiRequest = $client->request('GET', config('app.news_api_url') .$url_params.'&apiKey=' . config('app.news_api_key'));
            return json_decode($apiRequest->getBody()->getContents(), true);
        } catch (RequestException $e) {
            //For handling exception
           
            if ($e->hasResponse()) {
               
            }
        }
    }
    public function makeGuardianApiCalls($url_params)
    {
        try {
            $client = new Client();
            $apiRequest = $client->request('GET', config('app.guardian_api_url') .$url_params.'&api-key=' . config('app.guardian_api_key'));
            return json_decode($apiRequest->getBody()->getContents(), true);
        } catch (RequestException $e) {
            //For handling exception
         
            if ($e->hasResponse()) {
           
            }
        }
    }
    public function makeNewYorkTimesApiCalls($url_params)
    {
        try {
            $client = new Client();
            $apiRequest = $client->request('GET', config('app.newyorktimes_api_url') .$url_params.'&api-key=' . config('app.newyorktimes_api_key'));
            return json_decode($apiRequest->getBody()->getContents(), true);
        } catch (RequestException $e) {
            //For handling exception
           
            if ($e->hasResponse()) {
                
            }
        }
    }
}