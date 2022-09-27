<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
class loeschscraping extends Controller
{
    //
    public function index()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://rehatechnik-loesch.de/epages/28217883-5758-41f3-aed8-73e7cb276b49.sf/de_DE/?ObjectPath=/Shops/28217883-5758-41f3-aed8-73e7cb276b49/Products/349886453&ViewAction=ViewProductRating');
        $data=array();
        $mainQuery="";
        $product_id=0;
        $returnedQuery = $crawler->filter('div[itemprop="review"]')->each(function ($nodechild) {
            // $date=$nodechild->filter('.product-detail-review-item-date')->first()->text();
                $current_data=[];
                $current_data["rating_value"]=$nodechild->filter('meta[itemprop="ratingValue"]')->first()->attr('content');
                $current_data["description"]=$nodechild->filter('div[itemprop="reviewBody"]')->first()->text();
                $current_data["title"]=$nodechild->filter('#productRatingTitle')->first()->text();
                $productRatingName=$nodechild->filter('.productRatingName')->first()->text();
                
                $current_data["date"] = explode("am",$productRatingName)[1];
                $name = explode("am",$productRatingName)[0];
                $current_data["name"] = explode('von', trim($name ))[1];
                echo "<pre>";
                // $data[] = $current_data;
                $current_data["date"]=date("Y-m-d", strtotime($current_data["date"]));
                // dd();
                // date("d-m-Y", strtotime($originalDate))
                // printf("Now:", Carbon::now($current_data["date"]));

                $date=$current_data['date'];
                $name=$current_data['name'];
                $description=$current_data['description'];
                $rating_value=$current_data['rating_value'];
                $title=$current_data['title'];

                $query="INSERT INTO `product_review`
                (`id`, `product_id`, `customer_id`, `sales_channel_id`, `language_id`,
                `external_user`, `external_email`, `title`, `content`, `points`,
                 `status`, `created_at`,`product_version_id`) 
                  VALUES 
                  (UUID(),0xd140548e7f7144098baf3a394bd3a60e,0x3c787124744841d8addeec4a7dc891fb,0xb4a62c25798347669ef73163c29c33a3,0x2fbb5fe2e29a4d70aa5854ce7ce3e20b,
                  '$name','hb@ebakery.de','$title','$description','$rating_value',
                  1,'$date',0x0fa91ce3e96a4bc2be4bd9ce752c3425)";
                $current_data['query']=$query;
                // return $query;
                // print_r($data);
                return $current_data;
            });
            // $mainQuery=$mainQuery.";".$returnedQuery;
                // dd("test");
                // echo "<pre>";
                // print_r($returnedQuery);echo";";
            foreach($returnedQuery as $query){
                echo "<pre>";
                print_r($query['query']);echo";";
            }
            dd($returnedQuery);
    }
}
