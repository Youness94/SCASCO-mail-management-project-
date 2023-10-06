<?php

namespace App\Http\Controllers;

use App\Models\ActeDeGestionSinistresAtRd;
use Illuminate\Http\Request;

class ActeDeGestionSinistresAtRdController extends Controller
{
    public function AllActeDeGestionSinistresAtRd()
    {
       $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::latest()->get();
        return view('actegestionatrd.list-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd'));//
    }

    public function AddActeDeGestionSinistresAtRd()
    {
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::latest()->get();
        return view('actegestionatrd.add-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd'));
        
    }

    public function StoreActeDeGestionSinistresAtRd(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            
        // Add more validation rules for other fields
        ]);

        $acte_de_gestion_sinistres_at_rd = new ActeDeGestionSinistresAtRd($validatedData);
        $acte_de_gestion_sinistres_at_rd->user_id = auth()->user()->id; // Associate the remuneration with the logged-in user
        $acte_de_gestion_sinistres_at_rd->save();

        return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte de gestion Sinistres created successfully');
        
        
      
    }

    public function ShowActeDeGestionSinistresAtRd($id)
    {
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::findOrFail($id);
        return view('actegestionatrd.show-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd'));
    }

    public function EditActeDeGestionSinistresAtRd($id)
    {
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::findOrFail($id);
        return view('actegestionatrd.edit-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd'));
    }

   
    public function UpdateActeDeGestionSinistresAtRd(Request $request, ActeDeGestionSinistresAtRd $acte_de_gestion_sinistres_at_rd)
    {
    
        
        $act_sin = $request->id;
        ActeDeGestionSinistresAtRd::findOrFail($act_sin)->update([
            'nom' => $request->nom,
            
            
            // Add more validation rules for other fields
        ]);
        $acte_de_gestion_sinistres_at_rd->user_id = auth()->user()->id;
        

        return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte de gestion Sinistres updated successfully');
    }

    public function DeleteActeDeGestionSinistresAtRd(ActeDeGestionSinistresAtRd $acte_de_gestion_sinistres_at_rd, $id)
    {
    
        ActeDeGestionSinistresAtRd::findOrFail($id)->delete();
        return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte de gestion Sinistres deleted successfully');
    }
}
