<?php

namespace App\Http\Controllers;

use App\Models\ActeDeGestionSinistresAtRd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $categories = DB::table('actes_gestion_sinister_atrd_categorie')->get();
        return view('actegestionatrd.add-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd', 'categories'));
        
    }

    public function StoreActeDeGestionSinistresAtRd(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'categorie' => 'nullable|string',
            // Add more validation rules for other fields
        ]);
    
        $user = auth()->user();
    
        if ($user) {
            $acte_de_gestion_sinistres_at_rd = new ActeDeGestionSinistresAtRd([
                'nom' => $request->input('nom'),
                'categorie' => $request->input('categorie'),
            ]);
    
            $acte_de_gestion_sinistres_at_rd->user()->associate($user);
            $acte_de_gestion_sinistres_at_rd->save();
    
            return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte Gestion created successfully');
        } else {
            return redirect()->back()->with('error', 'User not authenticated');
        }


      
        
        
      
    }

    public function ShowActeDeGestionSinistresAtRd($id)
    {
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::findOrFail($id);
        return view('actegestionatrd.show-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd'));
    }

    public function EditActeDeGestionSinistresAtRd($id)
    {
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::findOrFail($id);
        $categories = DB::table('actes_gestion_sinister_atrd_categorie')->get();
        return view('actegestionatrd.edit-actegestionatrd', compact('acte_de_gestion_sinistres_at_rd', 'categories'));
    }

   
    public function UpdateActeDeGestionSinistresAtRd(Request $request, ActeDeGestionSinistresAtRd $acte_de_gestion_sinistres_at_rd)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'categorie' => 'nullable|string',
            // Add more validation rules for other fields
        ]);
        $act_sin = $request->id;
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::findOrFail($act_sin);
    
        $acte_de_gestion_sinistres_at_rd->update([
            'nom' => $request->nom,
            'categorie' => $request->categorie,
            // Add more fields as needed
        ]);
    
        $acte_de_gestion_sinistres_at_rd->user_id = auth()->user()->id;
        $acte_de_gestion_sinistres_at_rd->save();
        

        return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte de gestion Sinistres updated successfully');
    }

        
     
    public function DeleteActeDeGestionSinistresAtRd(ActeDeGestionSinistresAtRd $acte_de_gestion_sinistres_at_rd, $id)
    {
    
        ActeDeGestionSinistresAtRd::findOrFail($id)->delete();
        return redirect('/tous/acte-gestion-sinistres-at-rd')->with('success', 'Acte de gestion Sinistres deleted successfully');
    }
}
