<?php

namespace App\Libraries\Messages\Interface;

interface Message {
    public function sendMessage(array $data): void;
}
