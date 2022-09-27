<?php

namespace App\Http\Controllers;

use App\Models\GambioCategory;
use App\Models\GambioProject;
use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
class GambioCategoryController extends Controller
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
        $gambioProject=GambioProject::find($id);
        // dd($gambioProject);
        return view('gambio.category.index',compact('gambioProject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $gambioProject=GambioProject::find($id);

        $client = new Client();
        $crawler = $client->request('GET', $gambioProject->link);
        $data=array();
        $mainQuery="";
        $product_id=0;
            $navigationLinks = $crawler->filter('nav.navbar-default.navbar-categories')->each(function ($nodechild) {
                $level2=$nodechild->filter('ul[data-level="2"]');
                $anchortags = $level2->filter('a')->each(function ($level3) {
                   $data=[];
                   $data['name']=$level3->first()->text();
                   $data['link']=$level3->first()->attr('href');;
                   return  $data;
                });
                return $anchortags;
            });
        
            foreach($navigationLinks[0] as $navigationLink){
                $gambioCategory=new GambioCategory;
                $gambioCategory->gambio_project_id=$gambioProject->id;
                $gambioCategory->link=$navigationLink['link'];
                $gambioCategory->name=$navigationLink['name'];
                $gambioCategory->save();
            }
            // dd($navigationLinks);

            // $gambioProject=GambioProject::find($id);

            return redirect()->route('gambioProjectCategory.index',$gambioProject->id);
    }

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
     * @param  \App\Models\GambioCategory  $gambioCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GambioCategory $gambioCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambioCategory  $gambioCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GambioCategory $gambioCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambioCategory  $gambioCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambioCategory $gambioCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambioCategory  $gambioCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambioCategory $gambioCategory)
    {
        //
    }
}
