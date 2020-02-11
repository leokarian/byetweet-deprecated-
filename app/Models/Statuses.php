<?php

namespace ByeTweets\Models;

use ByeTweets\Helpers\MyTwitterConnection;
use Illuminate\Support\Facades\Log;

class Statuses
{

    protected $statuses = [];

    public function __construct($params = null)
    {
        $connection = MyTwitterConnection::connect();
        if ($params['count'] <= 200) {
            $statuses = $connection->get(
                "statuses/user_timeline", 
                [
                    "count" => $params['count'], 
                    "include_rts" => 1, 
                    "exclude_replies" => 0, 
                    "tweet_mode" => "extended"
                ]
            );
        } else {
            $allStatuses = [];
            $limit = $params['count'];
            $cantTwAct = 0;
            $statuses = $connection->get(
                "statuses/user_timeline", 
                [
                    "count" => 200, 
                    "include_rts" => 1, 
                    "exclude_replies" => 0, 
                    "tweet_mode" => "extended"
                ]);
            $cantTwAct += count($statuses);
            while ((count($statuses) > 0) && ($cantTwAct < $limit)) {
                $allStatuses = array_merge($allStatuses,$statuses);
                $max_id = ($statuses[count($statuses)-1]->id)-1;
                $statuses = $connection->get(
                    "statuses/user_timeline", 
                    [
                        "count" => 200, 
                        "max_id" => $max_id, 
                        "include_rts" => 1, 
                        "exclude_replies" => 0
                    ]);
                if (count($statuses) == 0) {
                    Log::info('NO HAY MAS TWEETS!!!');
                }
                $cantTwAct += count($statuses);
            }
            $statuses = $allStatuses;
        }
        
        foreach ($statuses as $status) {
            $this->addStatus(new Tweet($status));
        }
    }

    private function addStatus(Tweet $status)
    {
        array_push($this->statuses, $status); 
    }

    public function getStatuses()
    {
        return $this->statuses;
    }

    public function getTweeteros(array $statuses)
    {
        $tweeteros = [];
        foreach ($statuses as $st) {
            $screenName = $st->getUser()->getScreenName();
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
