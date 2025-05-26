<?php

namespace App\Http\Controllers;

use App\Models\fichier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FichierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('fichier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'filename' => 'required|file',
            'filename2' => 'required|file'
        ]);

        $champsPdf = [
            'filename',
            'filename2',
        ];
        $data=[];

        $fichier = fichier::findOrFail(1);

        if ($fichier->filename) {
            Storage::disk('public')->delete('uploads/' . $fichier->filename);
        }
        if ($fichier->filename2) {
            Storage::disk('public')->delete('uploads/' . $fichier->filename2);
        }

        $fichier->update(
            [
                'filename' => '',
                'filename2' => '',
            ]
        );

        foreach ($champsPdf as $pdf) {
            //Pour chaque pdfs du formulaire, si le pdf existe on le récupère et on récupère son nom
            if ($request->hasFile($pdf)) {
                $fichier = $request->file($pdf);
                $nomPdf = $fichier->getClientOriginalName();
                // On sauvegarde le pdf dans le dossier correspondant au bon CRI
                $fichier->storeAs("uploads", $nomPdf, 'public');
                // On enregistre le nom du pdf dans la base
                $data[$pdf] = $nomPdf;
            }
        }

        fichier::updateOrCreate(
            ['id' => 1],
            $data
        );

        return redirect()->route('fichier.index');
    }

}
