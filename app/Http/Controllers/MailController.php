<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSendRequest;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function show() {
        return view('mail.form');
    }

    public function send(ContactSendRequest $information) {

        $information = $information->all();
        Mail::to($information['department'])
            ->send(new Contact($information));

        return redirect()->route('contact.acknowledgement');
    }

    public function acknowledgement() {
        return view('mail.acknowledgement');
    }
}
