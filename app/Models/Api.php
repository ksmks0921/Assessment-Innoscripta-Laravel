<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Illuminate\Support\Arr;

class Api extends Model
{
    public function fetchNewsFromSource($searchKeyword, $category, $from, $to)
    {
        if($from == '' && $searchKeyword == "") {
            $urlParams = 'top-headlines?category='.$category;
        } else {
            $urlParams = 'everything?sources=cnn&from='.$from.'&to='.$to.'&q='.$searchKeyword; 
        }   
        $response = (new Helper)->makeNewsApiCalls($urlParams);
        return Arr::get($response,'articles');
    }
    public function fetchGuardianNewsFromSource($searchKeyword, $category, $from_date, $to_date)
    {
        if($from_date == "") {
            $urlParams = 'search?q=' . $category; 
        } else {
            $urlParams = 'search?q=' . $category.'&from-date='.$from_date.'&to-date='.$to_date; 
        }
              
        $response = (new Helper)->makeGuardianApiCalls($urlParams);
        return Arr::get($response,'response.results');
    }
    public function fetchNewYorkTimesNewsFromSource($searchKeyword, $category, $begin_date, $end_date)
    {
        if($begin_date == "" && $searchKeyword == "") {
            $urlParams = 'svc/topstories/v2/'.$category.'.json?';
            $response = (new Helper)->makeNewYorkTimesApiCalls($urlParams);
            return Arr::get($response,'results');

        } else {
            $urlParams = 'svc/search/v2/articlesearch.json?begin_date='.$begin_date.'&end_date='.$end_date.'&q='.$searchKeyword; 
            $response = (new Helper)->makeNewYorkTimesApiCalls($urlParams);
            return Arr::get($response,'response.docs');           
        }       
        
    }

}
