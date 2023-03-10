<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message to send.
     */
    private $message;
    /**
     * User destination info.
     */
    private $sender;

    /**
     * Id of the receiver.
     */
    private $receiver;

    /**
     * Courrier
     */
    private $courrier;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->receiver = [
            'id' => $data['receiver_id'],
            'role' => $data['receiver_role']
        ];

        $this->message = [
            'title' => $data['title'],
            'content' => $data['content'],
        ];

        $this->sender = [
            'id' => $data['user_id'],
            'profile' => $data['user_profile'],
            'name' => $data['user_name'],
            'surname' => $data['user_surname'],
        ];

        $this->courrier = [
            'tache' => isset($data['courrier_tache']) ? $data['courrier_tache'] : null,
            'id' => $data['courrier_id'],
            'action' => $data['courrier_action']
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('gestdoc-channel.' . $this->receiver['id']);
    }

    public function broadcastAs()
    {
        return "gestdoc-notify";
    }

    public function broadcastWith ()
    {
        return [
            'receiver' => $this->receiver,
            'sender' => $this->sender,
            'message' =>  $this->message,
            'courrier' => $this->courrier,
        ];
    }
}
