<?php

namespace App\Http\Controllers;

use App\Exports\SinistreExport;
use App\Models\ActeDeGestionSinistresAtRd;
use App\Models\BranchSinistresAtRd;
use App\Models\ChargeCompteSinistres;
use App\Models\Compagnie;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class SinistresAtRDController extends Controller
{
    public function AllSinistres()
    {


        $sinistres = Sinistre::with('branches_sinistres', 'compagnies', 'acte_de_gestion_sinistres', 'charge_compte_sinistres')->get();
        return view('sinistresatrd.list-sinistresatrd', compact('sinistres'));
    }

    public function FilterSinistre(Request $request)
    {
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        // Start with a query builder
        $query = Sinistre::query();

        // Check if date_debut is not empty
        if (!empty($date_debut)) {
            $query->whereDate('date_reception', '>=', $date_debut);
        }

        // Check if date_fin is not empty
        if (!empty($date_fin)) {
            $query->whereDate('date_reception', '<=', $date_fin);
        }

        // Fetch the filtered productions
        $sinistres = $query->get();

        // Determine if data exists
        $dataExists = !$sinistres->isEmpty();

        return view('sinistresatrd.list-sinistresatrd', compact('sinistres', 'date_debut', 'date_fin', 'dataExists'));
    }

    public function ExportSinistres(Request $request)
    {
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        // Vérifie s'il y a des données à la date spécifiée
        $dataExists = Sinistre::whereDate('date_reception', '>=', $date_debut)
            ->whereDate('date_reception', '<=', $date_fin)
            ->exists();

        // Si des données existent, génère le fichier Excel et le télécharge
        if ($dataExists) {
            $export = new SinistreExport($date_debut, $date_fin);
            return Excel::download($export, 'sinistres_filtres.xlsx');
        } else {
            // Redirige ou affiche un message d'erreur, selon ce que vous préférez
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page précédente :
            return redirect()->back()->with('error', 'Aucune donnée disponible pour la période spécifiée.');
        }
    }

    public function ResetSinistreFilter()
    {
        // Fetch all productions without any filtering
        $sinistres = Sinistre::all();

        // Return the view with the unfiltered productions
        return view('sinistresatrd.list-sinistresatrd', compact('sinistres'));
    }

    public function AddSinistre()
    {
        // Retrieve lists of related models for dropdowns
        $branches_sinistres_at_rd = BranchSinistresAtRd::all();
        $compagnies = Compagnie::all();
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::all();
        $charge_compte_sinistres_at_rd = ChargeCompteSinistres::all();
        $sinistres = Sinistre::latest()->get();

        return view('sinistresatrd.add-sinistresatrd', compact('branches_sinistres_at_rd', 'compagnies', 'acte_de_gestion_sinistres_at_rd', 'charge_compte_sinistres_at_rd'));
    }

    public function ShowSinistre($id)
    {
        // Find the production record by ID along with its related data
        $sinistres = Sinistre::with(['branches_sinistres', 'compagnies', 'acte_de_gestion_sinistres', 'charge_compte_sinistres'])
            ->findOrFail($id);

        // Return the production details view with the related data
        return view('sinistresatrd.show-sinistresatrd', compact('sinistres'));
    }

    public function StoreSinistre(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'branche_sinistre_id' => 'required|exists:branches_sinistres_at_rd,id',
            'compagnie_id' => 'required|exists:compagnies,id',
            'acte_de_gestion_sinistre_id' => 'required|exists:acte_de_gestion_sinistres_at_rd,id',
            'charge_compte_sinistre_id' => 'required|exists:charge_compte_sinistres_at_rd,id',
            'nom_assure' => 'required|string',
            'nom_police' => 'required|string',
            'num_sinistre' => 'required|string',
            'nom_victime' => 'required|string',
            'date_reception' => 'required|date',
            'date_remise' => 'required|date',
            'date_traitement' => 'required|date',
            'observation' => 'nullable|string',
        ]);
    
        // Calculate the delai_traitement while excluding weekends
        $delaiTraitement = $this->calculateDelaiTraitement(
            $validatedData['date_remise'],
            $validatedData['date_traitement']
        );
    
        // Create a new Sinistre instance
        $sinistre = new Sinistre([
            'branche_sinistre_id' => $validatedData['branche_sinistre_id'],
            'compagnie_id' => $validatedData['compagnie_id'],
            'acte_de_gestion_sinistre_id' => $validatedData['acte_de_gestion_sinistre_id'],
            'charge_compte_sinistre_id' => $validatedData['charge_compte_sinistre_id'],
            'nom_assure' => $validatedData['nom_assure'],
            'nom_police' => $validatedData['nom_police'],
            'num_sinistre' => $validatedData['num_sinistre'],
            'nom_victime' => $validatedData['nom_victime'],
            'date_reception' => $validatedData['date_reception'],
            'date_remise' => $validatedData['date_remise'],
            'date_traitement' => $validatedData['date_traitement'],
            'observation' => $validatedData['observation'],
            'delai_traitement' => $delaiTraitement,
        ]);
    
        // Associate the sinistre with the logged-in user
        $sinistre->user_id = auth()->user()->id;
    
        // Save the Sinistre record
        $sinistre->save();
    
        // Redirect to the index page or another appropriate page
        return redirect('/tous/sinistres-at-rd')->with('success', 'Sinistre record created successfully');
    }
    

    private function calculateDelaiTraitement($dateRemise, $dateTraitement)
    {
        $start = Carbon::parse($dateRemise);
        $end = Carbon::parse($dateTraitement);

        // Calculate the total days excluding weekends
        $totalDays = $start->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend(); // Exclude weekends
        }, $end);

        return $totalDays;
    }


    public function EditSinistre($id)
    {
        // Find the production record by ID along with its related data
        $sinistre = Sinistre::with(['branches_sinistres', 'compagnies', 'acte_de_gestion_sinistres', 'charge_compte_sinistres'])->findOrFail($id);;

        // Retrieve lists of related models for dropdowns
        $branches_sinistres_at_rd = BranchSinistresAtRd::all();
        $compagnies = Compagnie::all();
        $acte_de_gestion_sinistres_at_rd = ActeDeGestionSinistresAtRd::all();
        $charge_compte_sinistres_at_rd = ChargeCompteSinistres::all();

        // Return the edit production view with the related data

        return view('sinistresatrd.edit-sinistresatrd', compact('sinistre', 'branches_sinistres_at_rd', 'compagnies', 'acte_de_gestion_sinistres_at_rd', 'charge_compte_sinistres_at_rd'));
    }


    public function UpdateSinistre(Request $request, Sinistre $sinistre, $id)
    {
        $validatedData = $request->validate([
            'branche_sinistre_id' => 'required|exists:branches_sinistres_at_rd,id',
            'compagnie_id' => 'required|exists:compagnies,id',
            'acte_de_gestion_sinistre_id' => 'required|exists:acte_de_gestion_sinistres_at_rd,id',
            'charge_compte_sinistre_id' => 'required|exists:charge_compte_sinistres_at_rd,id',
            'nom_assure' => 'required|string',
            'nom_police' => 'required|string',
            'num_sinistre' => 'required|string',
            'nom_victime' => 'required|string',
            'date_reception' => 'required|date',
            'date_remise' => 'required|date',
            'date_traitement' => 'required|date',
            'observation' => 'nullable|string',
        ]);

        // Calculate the delai_traitement while excluding weekends
        $delaiTraitement = $this->calculateDelaiTraitement(
            $validatedData['date_remise'],
            $validatedData['date_traitement']
        );

        // Find the Sinistre record by ID
        $sinistre = Sinistre::findOrFail($id);

        // Update the Sinistre record
        $sinistre->update([
            'branche_sinistre_id' => $validatedData['branche_sinistre_id'],
            'compagnie_id' => $validatedData['compagnie_id'],
            'acte_de_gestion_sinistre_id' => $validatedData['acte_de_gestion_sinistre_id'],
            'charge_compte_sinistre_id' => $validatedData['charge_compte_sinistre_id'],
            'nom_assure' => $validatedData['nom_assure'],
            'nom_police' => $validatedData['nom_police'],
            'num_sinistre' => $validatedData['num_sinistre'],
            'nom_victime' => $validatedData['nom_victime'],
            'date_reception' => $validatedData['date_reception'],
            'date_remise' => $validatedData['date_remise'],
            'date_traitement' => $validatedData['date_traitement'],
            'observation' => $validatedData['observation'],
            'delai_traitement' => $delaiTraitement,
        ]);

        // Optionally, you can update the user_id if needed
        $sinistre->user_id = auth()->user()->id;

        // Redirect to the index page or another appropriate page
        return redirect('/tous/sinistres-at-rd')->with('success', 'Sinistre record updated successfully');
    }

    public function DeleteSinistre(Sinistre $sinistre, $id)
    {

        Sinistre::findOrFail($id)->delete();
        return redirect('/tous/sinistres-at-rd')->with('success', 'Production deleted successfully');
    }


    // ======= admin sinisters at and rd functions ====== 

    
}
