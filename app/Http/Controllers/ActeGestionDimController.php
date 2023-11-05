<?php

namespace App\Http\Controllers;

use App\Models\ActeGestionDim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActeGestionDimController extends Controller
{
    public function AllActeDeGestionSinistresDim()
    {
        $acte_gestions_dim = ActeGestionDim::latest()->get();
        return view('actegestiondim.list-actegestiondim', compact('acte_gestions_dim')); //
    }

    public function AddActeDeGestionSinistreDim()
    {
        if (auth()->check()) {
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->get();
        $acte_gestions_dim = ActeGestionDim::latest()->get();
        return view('actegestiondim.add-actegestiondim', compact('acte_gestions_dim', 'categories'));
    } else {
        // User is not authenticated, redirect to the login page
        return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
    }
    }

    public function StoreActeDeGestionSinistreDim(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|string|max:100',
            'categorie' => 'nullable|string',
        ]);

        $user = auth()->user();

        if ($user) {
            $acte_gestions_dim = new ActeGestionDim([
                'nom' => $request->input('nom'),
                'categorie' => $request->input('categorie'),
            ]);

            $acte_gestions_dim->user()->associate($user);
            $acte_gestions_dim->save();

            return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Créé Avec Succès');
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }

    public function ShowActeDeGestionSinistreDim($id)
    {
        if (auth()->check()) {
        $acte_gestions_dim = ActeGestionDim::findOrFail($id);
        return view('actegestiondim.show-actegestiondim', compact('acte_gestions_dim'));
    } else {
        // User is not authenticated, redirect to the login page
        return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
    }
    }

    public function EditActeDeGestionSinistreDim($id)
    {
        if (auth()->check()) {
        $acte_gestions_dim = ActeGestionDim::findOrFail($id);
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->get();
        return view('actegestiondim.edit-actegestiondim', compact('acte_gestions_dim', 'categories'));
    } else {
        // User is not authenticated, redirect to the login page
        return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
    }
    }


    public function UpdateActeDeGestionSinistreDim(Request $request, ActeGestionDim $acte_gestions_dim)
    {
        if (auth()->check()) {
        $request->validate([
            'nom' => 'required|string|max:100',
            'categorie' => 'nullable|string',
        ]);
        $act_sin = $request->id;
        $act_gestion_sin = ActeGestionDim::findOrFail($act_sin);

        $act_gestion_sin->update([
            'nom' => $request->nom,
            'categorie' => $request->categorie,
        ]);

        $act_gestion_sin->user_id = auth()->user()->id;
        $act_gestion_sin->save();


        $acte_gestions_dim->user_id = auth()->user()->id;


        return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Modifier Avec Succès');
    } else {
        // User is not authenticated, redirect to the login page
        return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
    }
    }

    public function DeleteActeDeGestionSinistreDim(ActeGestionDim $acte_gestions_dim, $id)
    {

        ActeGestionDim::findOrFail($id)->delete();
        return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Supprimer Avec Succès');
    }
}
