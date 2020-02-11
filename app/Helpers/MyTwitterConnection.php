<?php

namespace ByeTweets\Helpers;

use Abraham\TwitterOAuth\TwitterOAuth;

class MyTwitterConnection {

    private $connection;

    public function __construct()
    {
        if (! $connection = session('TwitterAuth')){
            $connection = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_ACCESS_TOKEN'), env('TW_ACCESS_TOKEN_SECRET'));
            session(['TwitterAuth' => $connection]);
            print_r('Se loguea en Twitter');
        }
        $this->connection = $connection;
    }

    public static function connect() {
        return app(MyTwitterConnection::class)->getConnection();
    }

    public function getConnection(){
        return $this->connection;
    }

}