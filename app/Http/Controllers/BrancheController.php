<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    public function AllBranches()
    {
       $branches = Branche::latest()->get();// Retrieve all remunerations from the database
        return view('branchproduction.list-branch-production', compact('branches'));//
    }

    public function AddBranche()
    {
        $branches = Branche::latest()->get();// Retrieve all remunerations from the database
        return view('branchproduction.add-branch-production', compact('branches'));
        
    }

    public function StoreBranche(Request $request)
{
    // Check if the user is authenticated
    if (auth()->check()) {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            // Add more validation rules for other fields
        ]);

        $branche = new Branche($validatedData);
        $branche->user_id = auth()->user()->id; // Associate the branche with the logged-in user
        $branche->save();

        return redirect('/tous/branches-production')->with('success', 'Branche created successfully');
    }

    // Handle the case where the user is not authenticated
    return redirect('/login')->with('error', 'You need to log in to perform this action.');
}

    public function ShowBranche($id)
    {
        $branches = Branche::findOrFail($id);
        return view('branchproduction.show-branch-production', compact('branches'));
    }

    public function EditBranche($id)
    {
        $branches = Branche::findOrFail($id);
        return view('branchproduction.edit-branch-production', compact('branches'));
    }

   
    public function UpdateBranche(Request $request, Branche $branches)
    {
    
        
        $bra = $request->id;
        Branche::findOrFail($bra)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);

        $branches->user_id = auth()->user()->id;
        return redirect('/tous/branches-production')->with('success', 'Branche updated successfully');
    }

    public function DeleteBranche(Branche $branche, $id)
    {
    
        Branche::findOrFail($id)->delete();
        return redirect('/tous/branches-production')->with('success', 'Branche deleted successfully');
    }
}
