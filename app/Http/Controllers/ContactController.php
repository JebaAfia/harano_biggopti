<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        // Prepare email data
        $details = [
            'title' => $validated['subject'] ?? 'New Contact Form Message',
            'body' => "Name: {$validated['name']}\nEmail: {$validated['email']}\n\nMessage:\n{$validated['message']}",
        ];

        // Send email
        Mail::raw($details['body'], function ($message) use ($details) {
            $message->to(env('MAIL_FROM_ADDRESS'))
                    ->subject($details['title']);
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
