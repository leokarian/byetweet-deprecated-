<?php

namespace ByeTweets\Models;

use Illuminate\Support\Facades\Log;

class Tweet 
{
    protected $createdAt;
    protected $id;
    protected $text;
    protected $truncated;
    protected $source;
    protected $inReplyToStatusId;
    protected $inReplyToUserId; 
    protected $inReplyToScreenName;
    protected $retweetCount;
    protected $favoriteCount;
    protected $retweeted;
    protected $lang;
    protected $user;
    protected $thumbnail;

    // Diferentes tipos de tweets
    //  https://gwu-libraries.github.io/sfm-ui/posts/2016-11-10-twitter-interaction

    public function __construct($status)
    {
        $this->id = $status->id;
        $this->createdAt = $status->created_at;
        if ($status->retweeted && isset($status->retweeted_status)){
            $status = $status->retweeted_status;
        }
        $this->text = $this::parseText($status);
        $this->truncated = $status->truncated;
        $this->source = $status->source;
        $this->inReplyToStatusId = $status->in_reply_to_status_id;
        $this->inReplyToUserId = $status->in_reply_to_user_id;
        $this->inReplyToScreenName = $status->in_reply_to_screen_name;
        $this->retweetCount = $status->retweet_count;
        $this->favoriteCount = $status->favorite_count;
        $this->retweeted = $status->retweeted;
        $this->lang = $status->lang;
        $this->user = new TwitterUser($status->user);
        if (isset($status->entities->media)) {
            $this->thumbnail = $status->entities->media[0]->media_url;
        }
        else {
            $this->thumbnail = false;
        }
        
    }

    private static function parseText($status)
    {
        if (isset($status->text)) {
            return $status->text;
        } elseif (isset($status->full_text)) {
            return $status->full_text;
        } else {
            return "(No se encuentra el texto del tweet)";
        }
        
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of truncated
     */ 
    public function getTruncated()
    {
        return $this->truncated;
    }

    /**
     * Get the value of source
     */ 
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Get the value of inReplyToStatusId
     */ 
    public function getInReplyToStatusId()
    {
        return $this->inReplyToStatusId;
    }

    /**
     * Get the value of inReplyToUserId
     */ 
    public function getInReplyToUserId()
    {
        return $this->inReplyToUserId;
    }

    /**
     * Get the value of inReplyToScreenName
     */ 
    public function getInReplyToScreenName()
    {
        return $this->inReplyToScreenName;
    }

    /**
     * Get the value of retweetCount
     */ 
    public function getRetweetCount()
    {
        return $this->retweetCount;
    }

    /**
     * Get the value of favoriteCount
     */ 
    public function getFavoriteCount()
    {
        return $this->favoriteCount;
    }

    /**
     * Get the value of retweeted
     */ 
    public function getRetweeted()
    {
        return $this->retweeted;
    }

    /**
     * Get the value of lang
     */ 
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the value of thumbnail
     */ 
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function hasThumbnail()
    {
        if ($this->thumbnail == false) {
            return false;
        }
        return true;
    }
}
