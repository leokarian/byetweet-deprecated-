<?php

namespace ByeTweets\Models;

use ByeTweets\Helpers\MyTwitterConnection;

class Profile 
{
    protected $user;

    public function __construct()
    {
        $connection = MyTwitterConnection::connect();
        $credentials = $connection->get("account/verify_credentials");
        $this->user = new TwitterUser($credentials);
    }

    public function getUser()
    {
        return $this->user;
    }
    

    public function getLastsStatuses(int $numStatuses)
    {
        $params = ["count" => $numStatuses];
        $statuses = new Statuses($params);
        return $statuses->getStatuses();
    }
}
