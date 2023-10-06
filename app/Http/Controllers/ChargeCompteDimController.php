<?php

namespace App\Http\Controllers;

use App\Models\ChargeCompteDim;
use Illuminate\Http\Request;

class ChargeCompteDimController extends Controller
{
    
    public function AllChargeCompteDim()
    {
       $charges_comptes_dim = ChargeCompteDim::latest()->get();
        return view('chargecomptedim.list-charge-compte-dim', compact('charges_comptes_dim'));//
    }

    public function AddChargeCompteDim()
    {
        $charges_comptes_dim = ChargeCompteDim::latest()->get();
        return view('chargecomptedim.add-charge-compte-dim', compact('charges_comptes_dim'));
        
    }

    public function StoreChargeCompteDim(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            
        // Add more validation rules for other fields
        ]);

        $charges_comptes_dim = new ChargeCompteDim($validatedData);
        $charges_comptes_dim->user_id = auth()->user()->id; // Associate the remuneration with the logged-in user
        $charges_comptes_dim->save();

        return redirect('/tous/charge-compte-sinistres-dim')->with('success', 'Branche created successfully');
        
        
      
    }

    public function ShowChargeCompteDim($id)
    {
        $charges_comptes_dim = ChargeCompteDim::findOrFail($id);
        return view('chargecomptedim.show-charge-compte-dim', compact('charges_comptes_dim'));
    }

    public function EditChargeCompteDim($id)
    {
        $charges_comptes_dim = ChargeCompteDim::findOrFail($id);
        return view('chargecomptedim.edit-charge-compte-dim', compact('charges_comptes_dim'));
    }

   
    public function UpdateChargeCompteDim(Request $request, ChargeCompteDim $charges_comptes_dim)
    {
    
        
        $bra_sin = $request->id;
        ChargeCompteDim::findOrFail($bra_sin)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);
        $charges_comptes_dim->user_id = auth()->user()->id;
        

        return redirect('/tous/charge-compte-sinistres-dim')->with('success', 'Branche updated successfully');
    }

    public function DeleteChargeCompteDim(ChargeCompteDim $charge_compte_sinistres_at_rd, $id)
    {
    
        ChargeCompteDim::findOrFail($id)->delete();
        return redirect('/tous/charge-compte-sinistres-dim')->with('success', 'Charge Compte deleted successfully');
    }
}
