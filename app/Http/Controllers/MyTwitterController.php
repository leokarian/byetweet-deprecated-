<?php

namespace ByeTweets\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use ByeTweets\Helpers\MyTwitterConnection;

class MyTwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$connection = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_ACCESS_TOKEN'), env('TW_ACCESS_TOKEN_SECRET'));
        $connection = MyTwitterConnection::connect();
        print_r($connection);
        $credentials = $connection->get("account/verify_credentials");
        $connection->resetLastResponse();

        //Con esto veo mi Timeline (los tweets de otros)
        //$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

        //Con esto creo un tweet
        //$statues = $connection->post("statuses/update", ["status" => "Hola gente 2!"]);

        //Con esto borro un tweet
        //$statues = $connection->post("statuses/destroy/1203018921764364288");

        return view('inicio', ['credentials' => $credentials]);
    }

    public function myTweets()
    {
        $connection = MyTwitterConnection::connect();
        print_r($connection);
        $statuses = $connection->get("statuses/user_timeline", ["count" => 20, "include_rts" => 1]);

        //Con esto veo mi Timeline (los tweets de otros)
        //$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);


        //Con esto creo un tweet
        //$statues = $connection->post("statuses/update", ["status" => "Hola gente 2!"]);

        //Con esto borro un tweet
        //$statues = $connection->post("statuses/destroy/1203018921764364288");
        $credentials = "";
        return view('myTweets', ['miCredencial' => $credentials ,'misTweets' => $statuses]);
    }

    public function meGusta()
    {
        
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
