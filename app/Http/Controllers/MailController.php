<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSendRequest;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailController extends Controller
{
    public function show() {
        return view('mail.form');
    }

    public function send(ContactSendRequest $information) {

        try {
            $information = $information->all();
            Mail::to($information['department'])
                ->send(new Contact($information));

            return redirect()->route('contact.acknowledgement');
        } catch(Throwable) {
            return view('messagePage.error', ['this message doesnt send']);
        }

    }

    public function acknowledgement() {
        return view('mail.acknowledgement');
    }
}
