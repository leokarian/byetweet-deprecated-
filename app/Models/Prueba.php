<?php

namespace ByeTweets\Models;

use ByeTweets\Helpers\MyTwitterConnection;
use Illuminate\Support\Facades\Log;

class Prueba 
{

    public function getPrueba()
    {
        $connection = MyTwitterConnection::connect();
        $id = 1187183959597301760;
        $params = ['id' => "$id"];
        $prueba = $connection->get("statuses/lookup", $params);
        Log::info(print_r($prueba,true));
        $show = $connection->get("statuses/show/".$id);
        Log::info(print_r($show,true));
        return $prueba;
    }
    

}
