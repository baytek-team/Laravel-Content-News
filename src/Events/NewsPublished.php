<?php

namespace Baytek\Laravel\Content\Types\News\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewsPublished implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $news;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($news)
    {
        $this->news = $news;
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('news.'.$this->news->id);
    }
}
