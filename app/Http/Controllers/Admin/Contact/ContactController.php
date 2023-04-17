<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\Contact\ContactIndexResource;

class ContactController extends Controller
{
    public function getContacts()
    {
        $contacts = Contact::latest()->get();
        return ContactIndexResource::collection($contacts);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
    }

}
