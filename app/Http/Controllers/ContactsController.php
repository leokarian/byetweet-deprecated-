<?php

namespace ByeTweets\Http\Controllers;

use Illuminate\Http\Request;
use ByeTweets\Helpers\MyTwitterConnection;

class ContactsController extends Controller
{
    public function seguidores()
    {
        $connection = MyTwitterConnection::connect();
        $followers = $connection->get("followers/list", ["skip_status" => true, "include_user_entities" => false])->users;
        return view('seguidores', ['seguidores' => $followers]);
    }

    public function siguiendo()
    {
        //Guardo esto en una variables de sesion porque estoy haciendo pruebas de diseño html 
        //  y no quiero llamar todo el tiempo a la API de twitter
        
        session()->keep('siguiendo');
        if (!$following = session('siguiendo')){
            $connection = MyTwitterConnection::connect();
            $following = $connection->get("friends/list", ["skip_status" => true, "include_user_entities" => false])->users;
            session(['siguiendo' => $following]);
        }
        return view('siguiendo', ['siguiendo' => $following]);
    }
}
