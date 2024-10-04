<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * create request contacts
     * 
     * @param Request $request
     * @param string $message
     */
    public function storeContact(ContactRequest $request)
    {
        $credentials = $request->validated();

        $newContact = Contact::create($credentials);

        return response()->json([
            'data' => 'OK',
        ]);
    }
}
