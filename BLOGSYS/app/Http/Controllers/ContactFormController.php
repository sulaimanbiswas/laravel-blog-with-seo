<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // We will create this next

class ContactFormController extends Controller
{

    public function contact()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // 1. Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Send the email
        // Replace 'your-recipient-email@gmail.com' with your actual Gmail address
        Mail::to('seoworkstool@gmail.com')->send(new ContactFormMail($validated));

        // 3. Redirect back with a success message
        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
