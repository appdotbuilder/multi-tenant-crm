<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Company;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('company')
            ->latest()
            ->paginate(10);
        
        return Inertia::render('contacts/index', [
            'contacts' => $contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::active()->orderBy('name')->get();
        
        return Inertia::render('contacts/create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load(['company', 'deals', 'tasks.assignedUser']);
        
        return Inertia::render('contacts/show', [
            'contact' => $contact
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $companies = Company::active()->orderBy('name')->get();
        
        return Inertia::render('contacts/edit', [
            'contact' => $contact,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());

        return redirect()->route('contacts.show', $contact)
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}