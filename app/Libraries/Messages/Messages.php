<?php
namespace App\Libraries\Messages;

use App\Libraries\Messages\Interface\Message;

class Messages {

    private $strategy;
    private $data;

    public function __construct(Message $strategy, array $data) {
        $this->strategy = $strategy;
        $this->data = $data;
    }

    public function send() {
        $this->strategy->sendMessage($this->data);
    }
}
