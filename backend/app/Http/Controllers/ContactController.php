<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\AmoCrmService;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function store(ContactRequest $request, AmoCrmService $amoCrmService, ContactService  $contactService)
    {
        $contact = Contact::create($request->validated());

        $contactInAmo = $amoCrmService->createContact($contact);
        $contactIdInAmo = $contactService->getContactId($contactInAmo['_embedded']);
        $noteInAmo = $amoCrmService->createNote($contact, $contactIdInAmo);

        $dealId = $request->input('deal_id');
        $amoCrmService->linkContactToDeal($contactIdInAmo, $dealId);

        return response()->json(['message' => 'Контакт успешно создан и связан со сделкой']);
    }
}
