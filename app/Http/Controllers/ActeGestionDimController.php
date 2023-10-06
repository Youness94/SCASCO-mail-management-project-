<?php

namespace App\Http\Controllers;

use App\Models\ActeGestionDim;
use Illuminate\Http\Request;

class ActeGestionDimController extends Controller
{
    public function AllActeDeGestionSinistresDim()
    {
       $acte_gestions_dim = ActeGestionDim::latest()->get();
        return view('actegestiondim.list-actegestiondim', compact('acte_gestions_dim'));//
    }

    public function AddActeDeGestionSinistreDim()
    {
        $acte_gestions_dim = ActeGestionDim::latest()->get();
        return view('actegestiondim.add-actegestiondim', compact('acte_gestions_dim'));
        
    }

    public function StoreActeDeGestionSinistreDim(Request $request)
    {

        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            // Add more validation rules for other fields
        ]);
    
        // Check if the user is authenticated before accessing the id property
        $user = auth()->user();
    
        if ($user) {
            $acte_gestions_dim = new ActeGestionDim($validatedData);
            $acte_gestions_dim->user_id = $user->id; // Associate the act_gestion with the logged-in user
            $acte_gestions_dim->save();
    
            return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Acte Gestion created successfully');
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->back()->with('error', 'User not authenticated');
        }
      
    }

    public function ShowActeDeGestionSinistreDim($id)
    {
        $acte_gestions_dim = ActeGestionDim::findOrFail($id);
        return view('actegestiondim.show-actegestiondim', compact('acte_gestions_dim'));
    }

    public function EditActeDeGestionSinistreDim($id)
    {
        $acte_gestions_dim = ActeGestionDim::findOrFail($id);
        return view('actegestiondim.edit-actegestiondim', compact('acte_gestions_dim'));
    }

   
    public function UpdateActeDeGestionSinistreDim(Request $request, ActeGestionDim $acte_gestions_dim)
    {
    
        
        $act_sin = $request->id;
        ActeGestionDim::findOrFail($act_sin)->update([
            'nom' => $request->nom,
            
            
            // Add more validation rules for other fields
        ]);
        $acte_gestions_dim->user_id = auth()->user()->id;
        

        return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Acte de gestion Sinistres updated successfully');
    }

    public function DeleteActeDeGestionSinistreDim(ActeGestionDim $acte_gestions_dim, $id)
    {
    
        ActeGestionDim::findOrFail($id)->delete();
        return redirect('/tous/acte-gestion-sinistres-dim')->with('success', 'Acte de gestion Sinistres deleted successfully');
    }
}
