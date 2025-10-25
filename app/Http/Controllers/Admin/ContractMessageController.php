<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contract;
use App\Models\ReciveMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContractMessageController extends Controller
{
    function index()
    {
        ReciveMail::query()->update(['seen' => 1]);
        $receivedMails = ReciveMail::all();
        return view('admin.contact-message.index', compact('receivedMails'));
    }

    function messageReply(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:255'],
            'reply' => ['required'],
        ]);

        try {
            $contact = Contract::where('language', 'en')->first();
            $fromEmail = $contact->email;

            Mail::to($request->email)->send(
                new ContactMail($request->subject, $request->reply, $fromEmail)
            );

            ReciveMail::where('id', $request->mail_id)->update(['replied' => 1]);

            toast(__('Mail sent successfully.'), 'success');

            return redirect()->back();
        } catch (\Exception $e) {

            toast(__('Mail failed: ' . $e->getMessage()), 'error');
        }
    }
}
