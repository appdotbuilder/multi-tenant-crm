<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateDealRequest;
use App\Models\Deal;
use App\Models\Company;
use App\Models\Contact;
use App\Models\User;
use Inertia\Inertia;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::with(['company', 'contact', 'assignedUser'])
            ->latest()
            ->paginate(10);
        
        return Inertia::render('deals/index', [
            'deals' => $deals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::active()->orderBy('name')->get();
        $contacts = Contact::active()->orderBy('first_name')->get();
        $users = User::orderBy('name')->get();
        
        return Inertia::render('deals/create', [
            'companies' => $companies,
            'contacts' => $contacts,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDealRequest $request)
    {
        $deal = Deal::create($request->validated());

        return redirect()->route('deals.show', $deal)
            ->with('success', 'Deal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $deal->load(['company', 'contact', 'assignedUser', 'tasks.assignedUser']);
        
        return Inertia::render('deals/show', [
            'deal' => $deal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $companies = Company::active()->orderBy('name')->get();
        $contacts = Contact::active()->orderBy('first_name')->get();
        $users = User::orderBy('name')->get();
        
        return Inertia::render('deals/edit', [
            'deal' => $deal,
            'companies' => $companies,
            'contacts' => $contacts,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealRequest $request, Deal $deal)
    {
        $deal->update($request->validated());

        return redirect()->route('deals.show', $deal)
            ->with('success', 'Deal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')
            ->with('success', 'Deal deleted successfully.');
    }
}