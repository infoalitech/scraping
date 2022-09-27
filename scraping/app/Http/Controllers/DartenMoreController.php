<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
class DartenMoreController extends Controller
{
    //
    public function index()
    {
        ini_set('max_execution_time', 800);
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.mydarts.ch/');
        $data=array();
        $mainQuery="";
        $product_id=0;
            $navigationLinks = $crawler->filter('nav.navbar-default.navbar-categories')->each(function ($nodechild) {
                $level2=$nodechild->filter('ul[data-level="2"]');
                $anchortags = $level2->filter('a')->each(function ($level3) {
                   return  $level3->first()->attr('href');
                });
                return $anchortags;
            });
            $productLinks=array();
            foreach ($navigationLinks[0] as $key => $retQuery) {
                $productLink=array();
                $productLink=$this->product_link($retQuery);
                $productLinks=array_merge($productLinks,$productLink);
            }
            dd($productLinks[200]);
    }
    public function product_link($retQuery){
        $client = new Client();
        $productLinks=array();
        $navCrawler = $client->request('GET', $retQuery);
        $productLinks[]= $navCrawler->filter('.product-url')->each(function ($navCraw) {
            return  $navCraw->first()->attr('href');
        });
        if($navCrawler->filter('ul.pagination')->first()->filter('li')->count() > 1){
            if($link=$navCrawler->filter('ul.pagination')->first()->filter('li')->last()->filter('a')->count() > 0){
                $link=$navCrawler->filter('ul.pagination')->first()->filter('li')->last()->filter('a')->first()->attr('href');
                $productLink=$this->product_link($link);
                $productLinks=array_merge($productLinks,$productLink);
            }
        }
        return $productLinks;
    }
}
