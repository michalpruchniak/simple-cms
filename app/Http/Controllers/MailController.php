<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSendRequest;
use Throwable;
use App\Libraries\Messages\Messages;
use App\Libraries\Messages\Strategy\SendMail;

class MailController extends Controller
{
    public function show() {
        return view('mail.form');
    }

    public function send(ContactSendRequest $information) {

        try {
            $information = $information->all();
            $mail = new Messages(new SendMail(), $information);
            $mail->send();
            // I know that in this case using strategy is not have
            // a sense but I want to practice this strategy :)
            // Other method is in comment

            // Mail::to($information['department'])
            //     ->send(new Contact($information));

            return redirect()->route('contact.acknowledgement');
        } catch(Throwable $th) {
            return view('messagePage.error', ['message' => 'this message doesnt send']);
        }

    }

    public function acknowledgement() {
        return view('mail.acknowledgement');
    }
}
