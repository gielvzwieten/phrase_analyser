<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhraseController extends Controller
{

    public function index(Request $request)
    {
        $nonTrimmedPhrase = $request->session()->get('phrase')['phrase'];
        $phrase = strtolower(str_replace(' ', '',trim($nonTrimmedPhrase)));
        $uniqueCharsInPhrase = (trim(count_chars($phrase, 3)));

        return view('welcome', compact('nonTrimmedPhrase', 'phrase', 'uniqueCharsInPhrase'));
    }

    public function store(Request $request)
    {
        $phrase = $request->validate([
            'phrase' => 'required|string|max:255'
        ]);

        session()->put('phrase', $phrase);
        return redirect('/');
    }
}
