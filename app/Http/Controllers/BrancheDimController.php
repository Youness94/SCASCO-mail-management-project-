<?php

namespace App\Http\Controllers;

use App\Models\BrancheDim;
use Illuminate\Http\Request;

class BrancheDimController extends Controller
{
    public function AllBranchesSinistresDim()
    {
       $branches_dim = BrancheDim::latest()->get();
        return view('branchdim.list-branchdim', compact('branches_dim'));//
    }

    public function AddBranchesSinistresDim()
    {
        $branches_dim = BrancheDim::latest()->get();
        return view('branchdim.add-branchdim', compact('branches_dim'));
        
    }

    public function StoreBranchesSinistresDim(Request $request)
    {

        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            // Add more validation rules for other fields
        ]);
    
        // Check if the user is authenticated before accessing the id property
        $user = auth()->user();
    
        if ($user) {
            $branches_dim = new BrancheDim($validatedData);
            $branches_dim->user_id = $user->id; // Associate the act_gestion with the logged-in user
            $branches_dim->save();
    
            return redirect('/tous/branches-sinistre-dim')->with('success', 'Acte Gestion created successfully');
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->back()->with('error', 'User not authenticated');
        }
        
      
    }

    public function ShowBranchesSinistresDim($id)
    {
        $branches_dim = BrancheDim::findOrFail($id);
        return view('branchdim.show-branchdim', compact('branches_dim'));
    }

    public function EditBranchesSinistresDim($id)
    {
        $branches_dim = BrancheDim::findOrFail($id);
        return view('branchdim.edit-branchdim', compact('branches_dim'));
    }

   
    public function UpdateBranchesSinistresDim(Request $request, BrancheDim $branches_dim)
    {
    
        
        $bra_dim = $request->id;
        BrancheDim::findOrFail($bra_dim)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);
        $branches_dim->user_id = auth()->user()->id;
        

        return redirect('/tous/branches-sinistre-dim')->with('success', 'Branche updated successfully');
    }

    public function DeleteBranchesSinistresDim(BrancheDim $branches_dim, $id)
    {
        BrancheDim::findOrFail($id)->delete();
        return redirect('/tous/branches-sinistre-dim')->with('success', 'Branche deleted successfully');
    }
}
