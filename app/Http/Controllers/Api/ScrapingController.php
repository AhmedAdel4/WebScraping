<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;

class ScrapingController extends Controller
{
    

    public function scraping(Request $request){
        $client = new Client();
        $data = [];
        $index = 0;
        $crawler = $client->request('GET', $request->websiteName);
        // $html = $crawler->outerHtml();
        // dd($html);
        $crawler->filter('html > head > title')->each(function ($node) use(&$index,&$data) {
             $data[$index]['PageTitle'] = $node->text();
           
            $index++;
       });
        $crawler->filter('ul > li')->each(function ($node) use(&$index,&$data) {
              $node->filter('div > div > span > span > span > a')->each(function ($node)use(&$index,&$data){

                $data[$index]['Author'] = $node->text();
              });

              $node->filter('div > h2 > a')->each(function ($node)use(&$index,&$data){

                $data[$index]['Title'] = $node->text();
              });
              $index++;
         });
         return response()->json([
            'status' => true,
            'message' => 'true',
            'data' => $data
        ], 200);
    }
  
}
