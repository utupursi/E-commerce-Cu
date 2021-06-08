<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application|Factory|View
     */
    public function index(string $lang, Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
               'full_name' => 'required|string|max:55',
                'email' => 'required|email',
                'subject' => 'required|max:55',
                'message' => 'required|max:1024'
            ]);

            $data = [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ];

            $mailTo = Setting::where(['key' => 'contact_email'])->first();

            if ($mailTo != null) {
                if (count($mailTo->availableLanguage) > 0) {
                    Mail::to($mailTo->availableLanguage[0]->value)->send(new ContactEmail($data));
                }
            }

        }

        $page = Page::where(['status' => true, 'slug' => 'contact-us'])->first();

        if ($request->method())
        if (!$page) {
            return abort('404');
        }
        return view('pages.contact.contact',[
            'page' => $page
        ]);
    }
}
