<?php
class tweet
{
    private $tweetId;
    private $tweetText;
    private $userId;
    private $originalTweetId;
    private $replyToTweetId;
    private $dateAdded;

    public function __get($property)
    {
        // Return any private data member
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    public function __construct($tweet_id, $tweet_text, $user_id, $date_added, $original_tweet_id = null, $reply_to_tweet_id = null)
    {
        $this->tweetId = $tweet_id;
        $this->tweetText = $tweet_text;
        $this->userId = $user_id;
        $this->dateAdded = $date_added;
        $this->originalTweetId = $original_tweet_id;
        $this->replyToTweetId = $reply_to_tweet_id;
    }

    public function toString()
    {
        return
            "Tweet ID: " . $this->tweetId . "<br>" .
            "Tweet Text: " . $this->tweetText . "<br>" .
            "User ID: " . $this->userId . "<br>" .
            "Original Tweet ID: " . $this->originalTweetId . "<br>" .
            "Reply To Tweet ID: " . $this->replyToTweetId . "<br>" .
            "Date Added: " . $this->dateAdded . "<br>";
    }
}
