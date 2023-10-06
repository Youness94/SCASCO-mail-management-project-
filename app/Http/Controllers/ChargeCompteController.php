<?php

namespace App\Http\Controllers;

use App\Models\ChargeCompte;
use Illuminate\Http\Request;

class ChargeCompteController extends Controller
{
    public function AllChargeComptes()
    {
       $charge_comptes = ChargeCompte::latest()->get();// Retrieve all remunerations from the database
        return view('chargecompteproduction.list-charge-compte-production', compact('charge_comptes'));//
    }

    public function AddChargeCompte()
    {
        $charge_comptes = ChargeCompte::latest()->get();// Retrieve all remunerations from the database
        return view('chargecompteproduction.add-charge-compte-production', compact('charge_comptes'));
        
    }

    public function StoreChargeCompte(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            
        // Add more validation rules for other fields
        ]);

        $charge_compte = new ChargeCompte($validatedData);
        $charge_compte->user_id = auth()->user()->id; // Associate the remuneration with the logged-in user
        $charge_compte->save();

        return redirect('/tous/charge-comptes-production')->with('success', 'Branche created successfully');
        
        
      
    }

    public function ShowChargeCompte($id)
    {
        $charge_comptes = ChargeCompte::findOrFail($id);
        return view('chargecompteproduction.show-charge-compte-production', compact('charge_comptes'));
    }

    public function EditChargeCompte($id)
    {
        $charge_comptes = ChargeCompte::findOrFail($id);
        return view('chargecompteproduction.edit-charge-compte-production', compact('charge_comptes'));
    }

   
    public function UpdateChargeCompte(Request $request, ChargeCompte $charge_comptes)
    {
    
        
        $cha_cpt = $request->id;
        ChargeCompte::findOrFail($cha_cpt)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);
        $charge_comptes->user_id = auth()->user()->id;
        

        return redirect('/tous/charge-comptes-production')->with('success', 'Branche updated successfully');
    }

    public function DeleteChargeCompte(ChargeCompte $act_gestion, $id)
    {
    
        ChargeCompte::findOrFail($id)->delete();
        return redirect('/tous/charge-comptes-production')->with('success', 'Branche deleted successfully');
    }
}
