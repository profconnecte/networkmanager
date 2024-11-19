<?php

namespace App\Http\Controllers;

use App\Models\Liens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LiensController extends Controller
{

    public function ajout()
    {
        return view('link.ajout');
    }

    public function create(Request $request)
    {
        $liens = Liens::all();

        $nomSite = $request->input('nomSite');
        $lien = $request->input('lien');
        $liens = array("nomSite" => $nomSite, "lien" => $lien);
        $liens = Liens::insert($liens);

        $liens = Liens::all();

        return view('link.link-list', ['link' => $liens]);
    }

    public function show(liens $liens)
    {
        $liens = liens::all();

        return view('link.link-list', ['link' => $liens]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\liens  $liens
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lien = Liens::find($id);
        return view('link.edit', ['link' => $lien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\liens  $liens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lien = Liens::find($id); // Récupérer l'enregistrement par son ID

        if (!$lien) {
            // Si l'enregistrement n'est pas trouvé, renvoyer une réponse appropriée
            return redirect()->back()->with('error', 'Enregistrement introuvable.');
        }
        // Mettre à jour les champs de l'enregistrement avec les valeurs du formulaire
        $lien->nomSite = $request->input('nomSite');
        $lien->lien = $request->input('lien');

        // Enregistrer les modifications
        $lien->save();

        // Rediriger avec un message de succès
        return redirect()->route('link')->with('success', 'Enregistrement mis à jour avec succès.');
    }

    public function delete($nomSite)
    {
        $liens = Liens::all();

        Liens::where('nomSite', $nomSite)->delete();

        $liens = liens::all();

        return view('link.link-list', ['link' => $liens]);
    }
}
