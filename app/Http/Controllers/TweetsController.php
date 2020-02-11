<?php

namespace ByeTweets\Http\Controllers;

use Illuminate\Http\Request;
use ByeTweets\Helpers\MyTwitterConnection;
use ByeTweets\Models\Statuses;
use Illuminate\Support\Facades\Log;


class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Guardo esto en una variables de sesion porque estoy haciendo pruebas de diseño html 
        //  y no quiero llamar todo el tiempo a la API de twitter
        $runSession = 1;
        $allStatuses = [];
        if ($runSession) {
            session()->remove('tweets');
            session()->keep('tweets');
            if (!$statuses = session('tweets')){
                Log::info('Hace peticiones de los tweets a la API de twitter');
                $params = ['count' => 1000];
                $statusClass = new Statuses($params);
                $statuses = $statusClass->getStatuses();
                $tweeteros = $statusClass->getTweeteros($statuses);
                session(['tweets' => $statuses]);
                session(['tweeteros' => $tweeteros]);
            }
            else {
                Log::info('Utiliza los tweets que hay en la variable de sesión');
            }
            return view('myTweets', ['misTweets' => $statuses, 'tweeteros' => $tweeteros]);

        } else {
            $params = ['count' => 30];
            $statusClass = new Statuses($params);
            $statuses = $statusClass->getStatuses();
            $tweeteros = $statusClass->getTweeteros($statuses);
            session(['tweets' => $statuses]);
            session(['tweeteros' => $tweeteros]);
            return view('myTweets', ['misTweets' => $statuses, 'tweeteros' => $tweeteros]);
        }
        
    }

    public function borrarTweets(Request $request)
    {
        $connection = MyTwitterConnection::connect();
        foreach ($request->input('selectedTweets') as $idTweet) {
            $res = $connection->post('statuses/destroy/'.$idTweet);
            if (! isset($res->errors)) {
                Log::info('Tweet con id = '.$idTweet . ' borrado!');
            } else {
                Log::info('Problemas borrando el tweet '. $idTweet .'. $res devuelve: ' . print_r($res,true));
            }
        }
        return redirect('mytweets');
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
