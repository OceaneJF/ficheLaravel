<?php

namespace App\Http\Controllers;

use App\Models\Lapin;
use Illuminate\Http\Request;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit(Lapin $lapin)
    {
        return view('lapin.index', ['lapin' => $lapin]);
    }

    public function update(Request $request, Lapin $lapin)
    {
        $lapin->update($request->all());
        return redirect()->route('lapin.index', ['lapin' => $lapin]);
    }

    public function autoUpdate(Request $request,Lapin $lapin)
    {
        $data = $request->validate([
            'fieldName' => 'required|in:name,size,email',
            'value' => 'nullable',
        ]);

        $lapin->{$data['fieldName']} = $data['value'];
        $lapin->save();
    }
}
