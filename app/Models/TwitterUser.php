<?php

namespace ByeTweets\Models;

class TwitterUser 
{
    protected $id;
    protected $name;
    protected $screenName;
    protected $location;
    protected $description;
    protected $followersCount;
    protected $friendsCount;
    protected $createdAt;
    protected $favouritesCount;
    protected $profileImageUrl; // profile_image_url
    protected $statusesCount;

    public function __construct($user)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->screenName = $user->screen_name;
        $this->location = $user->location;
        $this->description = $user->description;
        $this->followersCount = $user->followers_count;
        $this->friendsCount = $user->friends_count;
        $this->createdAt = $user->created_at;
        $this->favouritesCount = $user->favourites_count;
        $this->profileImageUrl = $user->profile_image_url;
        $this->statusesCount = $user->statuses_count;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }


    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of followers
     */ 
    public function getFollowersCount()
    {
        return $this->followersCount;
    }

    /**
     * Get the value of friends
     */ 
    public function getFriendsCount()
    {
        return $this->friendsCount;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the value of favouritesCount
     */ 
    public function getFavouritesCount()
    {
        return $this->favouritesCount;
    }

    /**
     * Get the value of profileImageUrl
     */ 
    public function getProfileImageUrl()
    {
        return $this->profileImageUrl;
    }

    /**
     * Get the value of statutesCount
     */ 
    public function getStatusesCount()
    {
        return $this->statusesCount;
    }

    /**
     * Get the value of screenName
     */ 
    public function getScreenName()
    {
        return $this->screenName;
    }
}
