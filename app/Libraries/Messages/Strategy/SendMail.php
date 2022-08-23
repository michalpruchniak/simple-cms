<?php
namespace App\Libraries\Messages\Strategy;

use App\Libraries\Messages\Interface\Message;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class SendMail implements Message {

    public function SendMessage(array $data): void {
        Mail::to($data['department'])
            ->send(new Contact($data));
    }
}
