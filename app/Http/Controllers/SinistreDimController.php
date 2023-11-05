<?php

namespace App\Http\Controllers;

use App\Exports\SinistreDimExport;
use App\Models\ActeGestionDim;
use App\Models\BrancheDim;
use App\Models\ChargeCompteDim;
use App\Models\Compagnie;
use App\Models\SinistreDim;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class SinistreDimController extends Controller
{
    public function AllSinistreDim()
    {
        if (auth()->check()) {

            $sinistres_dim = SinistreDim::with('branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim')->orderBy('created_at', 'desc')->get();
            return view('sinistresdim.list-sinistresdim', compact('sinistres_dim'));
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }

    public function FilterSinistreDim(Request $request)
    {

        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        // Start with a query builder
        $query = SinistreDim::query();

        // Check if date_debut is not empty
        if (!empty($date_debut)) {
            $query->whereDate('date_reception', '>=', $date_debut);
        }

        // Check if date_fin is not empty
        if (!empty($date_fin)) {
            $query->whereDate('date_reception', '<=', $date_fin);
        }

        // Fetch the filtered productions
        $sinistres_dim = $query->get();

        // Determine if data exists
        $dataExists = !$sinistres_dim->isEmpty();

        return view('sinistresdim.list-sinistresdim', compact('sinistres_dim', 'date_debut', 'date_fin', 'dataExists'));
    }

    public function ExportSinistreDim(Request $request)
    {
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        // Vérifie s'il y a des données à la date spécifiée
        $dataExists = SinistreDim::whereDate('date_reception', '>=', $date_debut)
            ->whereDate('date_reception', '<=', $date_fin)
            ->exists();

        // Si des données existent, génère le fichier Excel et le télécharge
        if ($dataExists) {
            $export = new SinistreDimExport($date_debut, $date_fin);
            return Excel::download($export, 'sinistres_dim_filtres.xlsx');
        } else {
            // Redirige ou affiche un message d'erreur, selon ce que vous préférez
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page précédente :
            return redirect()->back()->with('error', 'Aucune donnée disponible pour la période spécifiée.');
        }
    }

    public function ResetSinistreDimFilter()
    {
        // Fetch all productions without any filtering
        $sinistres_dim = SinistreDim::all();

        // Return the view with the unfiltered productions
        return view('sinistresdim.list-sinistresdim', compact('sinistres_dim'));
    }

    public function AddSinistreDim()
    {
        if (auth()->check()) {
            // Retrieve lists of related models for dropdowns
            $branches_dim = BrancheDim::all();
            $compagnies = Compagnie::all();
            $acte_de_gestion_dim = ActeGestionDim::all();
            $charge_compte_dim = ChargeCompteDim::all();
            $sinistres_dim = SinistreDim::latest()->get();

            return view('sinistresdim.add-sinistresdim', compact('branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim'));
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }

    public function ShowSinistreDim($id)
    {
        if (auth()->check()) {
            // Find the production record by ID along with its related data
            $sinistres_dim = SinistreDim::with(['branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim'])
                ->findOrFail($id);

            // Return the production details view with the related data
            return view('sinistresdim.show-sinistresdim', compact('sinistres_dim'));
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }

    public function StoreSinistreDim(Request $request)
    {
        if (auth()->check()) {
            // Validate incoming data
            $validatedData = $request->validate([
                'branche_dim_id' => 'required|exists:branches_dim,id',
                'compagnie_id' => 'required|exists:compagnies,id',
                'acte_gestion_dim_id' => 'required|exists:acte_gestions_dim,id',
                'charge_compte_dim_id' => 'required|exists:charges_comptes_dim,id',
                'nom_assure' => 'required|string',
                'num_declaration' => 'required|string',
                'nom_adherent' => 'required|string',
                'date_reception' => 'required|date',
                'date_remise' => 'required|date',
                'date_traitement' => 'nullable|date',
                'observation' => 'nullable|string',
            ]);

            // Calculate the delai_traitement while excluding weekends
            $delaiTraitement = $this->calculateDelaiTraitement(
                $validatedData['date_remise'],
                $validatedData['date_traitement']
            );

            // Create a new Production instance
            $sinistres_dim = new SinistreDim([
                'branche_dim_id' => $validatedData['branche_dim_id'],
                'compagnie_id' => $validatedData['compagnie_id'],
                'acte_gestion_dim_id' => $validatedData['acte_gestion_dim_id'],
                'charge_compte_dim_id' => $validatedData['charge_compte_dim_id'],
                'nom_assure' => $validatedData['nom_assure'],
                'num_declaration' => $validatedData['num_declaration'],
                'nom_adherent' => $validatedData['nom_adherent'],
                'date_reception' => $validatedData['date_reception'],
                'date_remise' => $validatedData['date_remise'],
                'date_traitement' => $validatedData['date_traitement'],
                'observation' => isset($validatedData['observation']) ? $validatedData['observation'] : null,
                'delai_traitement' => $delaiTraitement,
            ]);

            $sinistres_dim->user_id = auth()->user()->id;

            // Save the Production record
            $sinistres_dim->save();

            // Redirect to the index page or another appropriate page
            return redirect('/ajouter/sinistre-dim')->with('success', 'Créé Avec Succès');
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }



    private function calculateDelaiTraitement($dateRemise, $dateTraitement)
    {

        if ($dateTraitement === null) {
            return null; // Return null for "en cours"
        }

        $start = Carbon::parse($dateRemise);
        $end = Carbon::parse($dateTraitement);

        // Calculate the total days excluding weekends
        $totalDays = $start->diffInDaysFiltered(function (Carbon $date) {
            return !$date->isWeekend(); // Exclude weekends
        }, $end);

        return $totalDays;
    }


    public function EditSinistreDim($id)
    {
        if (auth()->check()) {
            // Find the production record by ID along with its related data
            $sinistres_dim = SinistreDim::with(['branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim'])->findOrFail($id);;

            // Retrieve lists of related models for dropdowns
            $branches_dim = BrancheDim::all();
            $compagnies = Compagnie::all();
            $acte_de_gestion_dim = ActeGestionDim::all();
            $charge_compte_dim = ChargeCompteDim::all();

            // Return the edit production view with the related data

            return view('sinistresdim.edit-sinistresdim', compact('sinistres_dim', 'branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim'));
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }


    public function UpdateSinistreDim(Request $request, SinistreDim $sinistres_dim, $id)
    {
        if (auth()->check()) {
            $validatedData = $request->validate([
                'branche_dim_id' => 'required|exists:branches_dim,id',
                'compagnie_id' => 'required|exists:compagnies,id',
                'acte_gestion_dim_id' => 'required|exists:acte_gestions_dim,id',
                'charge_compte_dim_id' => 'required|exists:charges_comptes_dim,id',
                'nom_assure' => 'required|string',
                'num_declaration' => 'required|string',
                'nom_adherent' => 'required|string',
                'date_reception' => 'required|date',
                'date_remise' => 'required|date',
                'date_traitement' => 'nullable|date',
                'observation' => 'nullable|string',


            ]);

            // Calculate the delai_traitement while excluding weekends
            $delaiTraitement = $this->calculateDelaiTraitement(
                $validatedData['date_remise'],
                $validatedData['date_traitement']
            );

            // Find the Sinistre record by ID
            $sinistres_dim = SinistreDim::findOrFail($id);

            // Update the Sinistre record
            $sinistres_dim->update([
                'branche_dim_id' => $validatedData['branche_dim_id'],
                'compagnie_id' => $validatedData['compagnie_id'],
                'acte_gestion_dim_id' => $validatedData['acte_gestion_dim_id'],
                'charge_compte_dim_id' => $validatedData['charge_compte_dim_id'],
                'nom_assure' => $validatedData['nom_assure'],
                'num_declaration' => $validatedData['num_declaration'],
                'nom_adherent' => $validatedData['nom_adherent'],
                'date_reception' => $validatedData['date_reception'],
                'date_remise' => $validatedData['date_remise'],
                'date_traitement' =>  isset($validatedData['date_traitement']) ? $validatedData['date_traitement'] : null,
                'observation' => $validatedData['observation'],
                'delai_traitement' => $delaiTraitement,


            ]);

            // Optionally, you can update the user_id if needed
            $sinistres_dim->user_id = auth()->user()->id;

            // Redirect to the index page or another appropriate page
            return redirect('/tous/sinistres-dim')->with('success', 'Modifier Avec Succès');
        } else {
            // User is not authenticated, redirect to the login page
            return redirect('/login')->with('error', 'Vous devez être connecté pour effectuer cette action');
        }
    }

    public function DeleteSinistreDim(SinistreDim $sinistres_dim, $id)
    {

        SinistreDim::findOrFail($id)->delete();
        return redirect('/tous/sinistres-dim')->with('success', 'Supprimer Avec Succès');
    }
}
