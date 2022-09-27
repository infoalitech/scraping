<?php

namespace App\Http\Controllers;

use App\Models\GambioProductLink;
use App\Models\GambioCategory;
use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
class GambioProductLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        // $gambioProject=GambioProject::all();
        $gambioCategory=GambioCategory::find($id);
        // dd($gambioProject);
        return view('gambio.product.index',compact('gambioCategory'));
    }

    public function create($id)
    {
        //
        ini_set('max_execution_time', 800);
        $gambioCategory=GambioCategory::find($id);
        $productLinks=array();
        // dd($gambioCategory);
        // foreach ($gambioCategory->gambioProductLinks as $key => $retQuery) {
            // dd($retQuery);
            $productLink=array();
            $productLink=$this->product_link($gambioCategory->link);
            $productLinks=array_merge($productLinks,$productLink);
        // }
        dd($productLinks);
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambioProductLink  $gambioProductLink
     * @return \Illuminate\Http\Response
     */
    public function show(GambioProductLink $gambioProductLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambioProductLink  $gambioProductLink
     * @return \Illuminate\Http\Response
     */
    public function edit(GambioProductLink $gambioProductLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambioProductLink  $gambioProductLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambioProductLink $gambioProductLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambioProductLink  $gambioProductLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambioProductLink $gambioProductLink)
    {
        //
    }
}
