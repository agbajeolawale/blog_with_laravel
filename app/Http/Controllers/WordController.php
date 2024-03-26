<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;


class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
     
        return view('words.index', [
            'words' => Word::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

        $request->user()->words()->create($validated);

 

        return redirect(route('words.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word): View
    {
        //

        Gate::authorize('update', $word);

 

        return view('words.edit', [

            'word' => $word,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word): RedirectResponse
    {
        //

        Gate::authorize('update', $word);

 

        $validated = $request->validate([

            'message' => 'required|string|max:255',

        ]);

 

        $word->update($validated);

 

        return redirect(route('words.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word): RedirectResponse
    {
        Gate::authorize('delete', $word);

 

        $word->delete();

 

        return redirect(route('words.index'));
    }
}
