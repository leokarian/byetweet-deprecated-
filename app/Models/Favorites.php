<?php

namespace ByeTweets\Models;

use ByeTweets\Helpers\MyTwitterConnection;
use Illuminate\Support\Facades\Log;

class Favorites
{

    protected $favorites = [];

    public function __construct($params = null)
    {
        $connection = MyTwitterConnection::connect();
        if ($params['count'] <= 200) {
            $favs = $connection->get("favorites/list", ["count" => $params['count']]);
        } else {
            $allFavs = [];
            $limit = $params['count'];
            $cantTwAct = 0;
            $favs = $connection->get("favorites/list", ["count" => 200]);
            $cantTwAct += count($favs);
            while ((count($favs) > 0) && ($cantTwAct < $limit)) {
                $allFavs = array_merge($allFavs,$favs);
                $max_id = ($favs[count($favs)-1]->id)-1;
                $favs = $connection->get("favorites/list", ["count" => 200, "max_id" => $max_id]);
                if (count($favs) == 0) {
                    Log::info('NO HAY MAS FAVORITOS!!!');
                }
                $cantTwAct += count($favs);
            }
            $favs = $allFavs;
        }
        
        foreach ($favs as $fav) {
            $this->addFavorite(new Tweet($fav));
        }
    }

    private function addFavorite(Tweet $favorite)
    {
        array_push($this->favorites, $favorite); 
    }

    public function getFavorites()
    {
        return $this->favorites;
    }

    public function getTweeteros(array $favorites)
    {
        $tweeteros = [];
        foreach ($favorites as $fav) {
            $screenName = $fav->getUser()->getScreenName();
            if (isset($tweeteros[$screenName])) {
                $tweeteros[$screenName] += 1;
            } else {
                $tweeteros[$screenName] = 1;
            }
        }
        arsort($tweeteros);
        return $tweeteros;
    }
}
