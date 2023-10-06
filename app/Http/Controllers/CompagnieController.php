<?php

namespace App\Http\Controllers;

use App\Models\Compagnie;
use Illuminate\Http\Request;

class CompagnieController extends Controller
{
    public function AllCompagnies()
    {
       $compagnies = Compagnie::latest()->get();// Retrieve all remunerations from the database
        return view('compagnies.list-compagnie', compact('compagnies'));//
    }

    public function AddCompagnie()
    {
        $compagnies = Compagnie::latest()->get();// Retrieve all remunerations from the database
        return view('compagnies.add-compagnie', compact('compagnies'));
        
    }

    public function StoreCompagnie(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            
        // Add more validation rules for other fields
        ]);

        $compagnie = new Compagnie($validatedData);
        $compagnie->user_id = auth()->user()->id; // Associate the remuneration with the logged-in user
        $compagnie->save();

        return redirect('/tous/compagnies')->with('success', 'Compagnie created successfully');
        
        
      
    }

    public function ShowCompagnie($id)
    {
        $compagnies = Compagnie::findOrFail($id);
        return view('compagnies.show-compagnie', compact('compagnies'));
    }

    public function EditCompagnie($id)
    {
        $compagnies = Compagnie::findOrFail($id);
        return view('compagnies.edit-compagnie', compact('compagnies'));
    }

   
    public function UpdateCompagnie(Request $request, Compagnie $compagnies)
    {
        
        $comp = $request->id;
        Compagnie::findOrFail($comp)->update([
            'nom' => $request->nom,
            // Add more validation rules for other fields
        ]);
        $compagnies->user_id = auth()->user()->id;
        

        return redirect('/tous/compagnies')->with('success', 'Compagnie updated successfully');
    }

    public function DeleteCompagnie(Compagnie $compagnie, $id)
    {
    
        Compagnie::findOrFail($id)->delete();
        return redirect('/tous/compagnies')->with('success', 'Compagnie deleted successfully');
    }
}
