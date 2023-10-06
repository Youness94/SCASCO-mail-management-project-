<?php

namespace App\Http\Controllers;

use App\Models\BranchSinistresAtRd;
use Illuminate\Http\Request;

class BranchSinistresAtRdController extends Controller
{
    public function AllBranchesSinistresAtRd()
    {
       $branches_sinistres_at_rd = BranchSinistresAtRd::latest()->get();
        return view('branchatrd.list-branchatrd', compact('branches_sinistres_at_rd'));//
    }

    public function AddBrancheSinistresAtRd()
    {
        $branches_sinistres_at_rd = BranchSinistresAtRd::latest()->get();
        return view('branchatrd.add-branchatrd', compact('branches_sinistres_at_rd'));
        
    }

    public function StoreBrancheSinistresAtRd(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            // Add more validation rules for other fields
        ]);
    
        // Check if the user is authenticated before accessing the id property
        $user = auth()->user();
    
        if ($user) {
            $branches_sinistres_at_rd = new BranchSinistresAtRd($validatedData);
            $branches_sinistres_at_rd->user_id = $user->id; // Associate the act_gestion with the logged-in user
            $branches_sinistres_at_rd->save();
    
            return redirect('/tous/branches-sinistres-at-rd')->with('success', 'Branche created successfully');
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->back()->with('error', 'User not authenticated');
        }
        
        
      
    }

    public function ShowBrancheSinistresAtRd($id)
    {
        $branches_sinistres_at_rd = BranchSinistresAtRd::findOrFail($id);
        return view('branchatrd.show-branchatrd', compact('branches_sinistres_at_rd'));
    }

    public function EditBrancheSinistresAtRd($id)
    {
        $branches_sinistres_at_rd = BranchSinistresAtRd::findOrFail($id);
        return view('branchatrd.edit-branchatrd', compact('branches_sinistres_at_rd'));
    }

   
    public function UpdateBrancheSinistresAtRd(Request $request, BranchSinistresAtRd $branches_sinistres_at_rd)
    {
    
        
        $bra_sin = $request->id;
        BranchSinistresAtRd::findOrFail($bra_sin)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);
        $branches_sinistres_at_rd->user_id = auth()->user()->id;
        

        return redirect('/tous/branches-sinistres-at-rd')->with('success', 'Branche updated successfully');
    }

    public function DeleteBrancheSinistresAtRd(BranchSinistresAtRd $branches_sinistres_at_rd, $id)
    {
    
        BranchSinistresAtRd::findOrFail($id)->delete();
        return redirect('/tous/branches-sinistres-at-rd')->with('success', 'Branche deleted successfully');
    }
}
