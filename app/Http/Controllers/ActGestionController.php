<?php

namespace App\Http\Controllers;

use App\Models\ActGestion;
use Illuminate\Http\Request;

class ActGestionController extends Controller
{
    public function AllActGestions()
    {
       $act_gestions = ActGestion::latest()->get();// Retrieve all remunerations from the database
        return view('actegestionproduction.list-actegestion-production', compact('act_gestions'));//
    }

    public function AddActGestion()
    {
        $act_gestions = ActGestion::latest()->get();// Retrieve all remunerations from the database
        return view('actegestionproduction.add-actegestion-production', compact('act_gestions'));
        
    }

    public function StoreActGestion(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:100',
        // Add more validation rules for other fields
    ]);

    // Check if the user is authenticated before accessing the id property
    $user = auth()->user();

    if ($user) {
        $act_gestion = new ActGestion($validatedData);
        $act_gestion->user_id = $user->id; // Associate the act_gestion with the logged-in user
        $act_gestion->save();

        return redirect('/tous/acte-gestions-production')->with('success', 'Acte Gestion created successfully');
    } else {
        // Handle the case where the user is not authenticated
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
        return view('actegestionproduction.edit-actegestion-production', compact('act_gestions'));
    }

   
    public function UpdateActGestion(Request $request, ActGestion $act_gestions)
    {
    
        
        $act_gest = $request->id;
        ActGestion::findOrFail($act_gest)->update([
            'nom' => $request->nom,
            
            // Add more validation rules for other fields
        ]);
        $act_gestions->user_id = auth()->user()->id;
        

        return redirect('/tous/acte-gestions-production')->with('success', 'Branche updated successfully');
    }

    public function DeleteActGestion(ActGestion $act_gestion, $id)
    {
    
        ActGestion::findOrFail($id)->delete();
        return redirect('/tous/acte-gestions-production')->with('success', 'Branche deleted successfully');
    }
}
