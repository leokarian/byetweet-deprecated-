<?php

namespace ByeTweets\Http\Controllers;

use ByeTweets\Helpers\MyTwitterConnection;
use Illuminate\Http\Request;
use ByeTweets\Http\Controllers\MyTwitterController as MyTw;
use ByeTweets\Models\Favorites;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function favorites()
    {
        $params = ['count' => 10000];
        $favClass = new Favorites($params);
        Log::info('Voy a buscar los favoritos');
        $likes = $favClass->getFavorites();
        $tweeteros = $favClass->getTweeteros($likes);
        // Log::info('Estos son los favoritos (me gusta):');
        // Log::info(print_r($likes, true));
        return view('meGusta', ['likes' => $likes, 'tweeteros' => $tweeteros]);
    }

    public function borrarFavoritos(Request $request)
    {
        $connection = MyTwitterConnection::connect();
        $selectedFavs = $request->input('selectedFavorites');
        if ($selectedFavs && count($selectedFavs)) {
            foreach ($selectedFavs as $idFav) {
                $res = $connection->post('favorites/destroy', ['id' => $idFav]);
                if (! isset($res->errors)) {
                    Log::info('Favorito con id = '.$idFav . ' borrado!');
                } else {
                    Log::info('Problemas borrando el favorito '. $idFav .'. $res devuelve: ' . print_r($res,true));
                }
            }
        }
        return redirect('megusta');
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
