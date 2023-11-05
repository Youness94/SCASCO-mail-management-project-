<?php

namespace App\Http\Controllers;

use App\Models\ActGestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActGestionController extends Controller
{
    public function AllActGestions()
    {
       $act_gestions = ActGestion::latest()->get();// Retrieve all remunerations from the database
        return view('actegestionproduction.list-actegestion-production', compact('act_gestions'));//
    }

    public function AddActGestion()
    {
        $categories = DB::table('actes_gestion_production_categorie')->get();
        $act_gestions = ActGestion::latest()->get();// Retrieve all remunerations from the database
        return view('actegestionproduction.add-actegestion-production', compact('act_gestions', 'categories'));
        
    }

    public function StoreActGestion(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:100',
        'categorie' => 'nullable|string',
        // Add more validation rules for other fields
    ]);

    $user = auth()->user();

    if ($user) {
        $actGestion = new ActGestion([
            'nom' => $request->input('nom'),
            'categorie' => $request->input('categorie'),
        ]);

        $actGestion->user()->associate($user);
        $actGestion->save();

        return redirect('/tous/acte-gestions-production')->with('success', 'Créé Avec Succès');
    } else {
        return redirect()->back()->with('error', 'User not authenticated');
    }
}

    public function ShowActGestion($id)
    {
        $act_gestions = ActGestion::findOrFail($id);
        return view('actegestionproduction.show-actegestion-production', compact('act_gestions'));
    }

    public function EditActGestion($id)
    {
        $act_gestions = ActGestion::findOrFail($id);
        $categories = DB::table('actes_gestion_production_categorie')->get();
        return view('actegestionproduction.edit-actegestion-production', compact('act_gestions', 'categories'));
    }

   
    public function UpdateActGestion(Request $request, ActGestion $act_gestions)
    {
    
        
        $request->validate([
            'nom' => 'required|string|max:100',
            'categorie' => 'nullable|string',
            // Add more validation rules for other fields
        ]);
    
        $act_gest = $request->id;
        $act_gestion = ActGestion::findOrFail($act_gest);
    
        $act_gestion->update([
            'nom' => $request->nom,
            'categorie' => $request->categorie,
            // Add more fields as needed
        ]);
    
        $act_gestion->user_id = auth()->user()->id;
        $act_gestion->save();
        

        return redirect('/tous/acte-gestions-production')->with('success', 'Modifier Avec Succès');
    }

    public function DeleteActGestion(ActGestion $act_gestion, $id)
    {
    
        ActGestion::findOrFail($id)->delete();
        return redirect('/tous/acte-gestions-production')->with('success', 'Supprimer Avec Succès');
    }
}
