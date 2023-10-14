<?php

namespace App\Http\Controllers;

use App\Models\ChargeCompte;
use Illuminate\Http\Request;
use App\Models\Production;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ActGestion;

class ProductioDetailsController extends Controller
{
    public function showProductionDetails()
    {
        return view('production.production-details');
    }

    public function getProductionChartDateRemise()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = Production::whereBetween('date_remise', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = Production::whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function getProductionChartDateTraitement()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = Production::whereBetween('date_traitement', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = Production::whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function getProductionChartDateTraitementNull()
    {
        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_traitement where it's equal to null for the last month and last 12 months
        $lastMonthData = Production::whereNull('date_traitement')->whereBetween('date_remise', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $last12MonthsData = Production::whereNull('date_traitement')->whereBetween('date_remise', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function calculateMeanDelaiTraitement()
    {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate the mean delai_traitement for the current month
        $meanDelaiCurrentMonth = Production::whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months
        $meanDelaiLast12Months = Production::whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Return data as JSON
        return response()->json([
            'meanDelaiCurrentMonth' => $meanDelaiCurrentMonth,
            'meanDelaiLast12Months' => $meanDelaiLast12Months,
        ]);
    }

    // ==========  ========== //
    public function getProductionChartByChargeCompte()
    {
        // Assuming your ChargeCompte model has a 'name' attribute
        $chargeComptes = ChargeCompte::all();

        // Your existing data retrieval logic
        $chargeCompteIds = Production::distinct('charge_compte_id')->pluck('charge_compte_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->whereMonth('date_remise', now()->month)
                ->count();

            $dateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', now()->month)
                ->count();

            $dateRemiseCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereMonth('date_remise', now()->month)
                ->count();

            // Get the name for each charge_compte_id
            $chargeCompte = $chargeComptes->find($chargeCompteId);
            $chargeCompteNames[$chargeCompteId] = $chargeCompte ? $chargeCompte->nom : null;
        }

        // Return data as JSON
        return response()->json([
            'chargeCompteIds' => $chargeCompteIds,
            'chargeCompteNames' => $chargeCompteNames,
            'nullDateTraitementCount' => $nullDateTraitementCount,
            'dateTraitementCount' => $dateTraitementCount,
            'dateRemiseCount' => $dateRemiseCount,
        ]);
    }

    // 12 months 

    public function getProductionChartChargeCompteTwelve()
    {
        // Assuming your ChargeCompte model has a 'name' attribute
        $chargeComptes = ChargeCompte::all();

        // Your existing data retrieval logic
        $chargeCompteIds = Production::distinct('charge_compte_id')->pluck('charge_compte_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->whereMonth('date_remise', '>=', now()->subMonths(12)->month)  // Modified condition
                ->count();

            $dateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', '>=', now()->subMonths(12)->month)  // Modified condition
                ->count();

            $dateRemiseCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereMonth('date_remise', '>=', now()->subMonths(12)->month)  // Modified condition
                ->count();

            // Get the name for each charge_compte_id
            $chargeCompte = $chargeComptes->find($chargeCompteId);
            $chargeCompteNames[$chargeCompteId] = $chargeCompte ? $chargeCompte->nom : null;
        }

        // Return data as JSON
        return response()->json([
            'chargeCompteIds' => $chargeCompteIds,
            'chargeCompteNames' => $chargeCompteNames,
            'nullDateTraitementCount' => $nullDateTraitementCount,
            'dateTraitementCount' => $dateTraitementCount,
            'dateRemiseCount' => $dateRemiseCount,
        ]);
    }

    
    public function getMeanDelaiTraitementByChargeCompte()
{
    // Your existing data retrieval logic
    $chargeComptes = ChargeCompte::all(); 

    $chargeCompteIds = Production::distinct('charge_compte_id')->pluck('charge_compte_id');

    $meanDelaiTraitementCurrentMonth = [];
    $meanDelaiTraitementLast12Months = [];
    $chargeCompteNames = [];

    foreach ($chargeCompteIds as $chargeCompteId) {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate the mean delai_traitement for the current month and charge_compte_id
        $meanCurrentMonth = Production::where('charge_compte_id', $chargeCompteId)
            ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months and charge_compte_id
        $meanLast12Months = Production::where('charge_compte_id', $chargeCompteId)
            ->whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        $meanDelaiTraitementCurrentMonth[$chargeCompteId] = $meanCurrentMonth ?? 0; // Default to 0 if null
        $meanDelaiTraitementLast12Months[$chargeCompteId] = $meanLast12Months ?? 0; // Default to 0 if null

        $chargeCompte = $chargeComptes->find($chargeCompteId);
        $chargeCompteNames[$chargeCompteId] = $chargeCompte ? $chargeCompte->nom : null;
    }

    // Return data as JSON with charge compte ids and names
    return response()->json([
        'chargeCompteIds' => $chargeCompteIds,
        'chargeCompteNames' => $chargeCompteNames,
        'meanDelaiTraitementCurrentMonth' => $meanDelaiTraitementCurrentMonth,
        'meanDelaiTraitementLast12Months' => $meanDelaiTraitementLast12Months,
    ]);
}



public function getActGestionProductionCategorie()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Retrieve data for the chart using Eloquent relationships
    $actGestionData = Production::with('act_gestions')
        ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
        ->whereNotNull('delai_traitement')
        ->get(['act_gestion_id', 'delai_traitement']);

    // Initialize an array to store the organized data
    $chartData = [];

    foreach ($actGestionData as $record) {
        $categorieName = optional($record->act_gestions)->categorie ?? 'Unknown';

        // Increment the total delai_traitement for each category
        $chartData[$categorieName] = ($chartData[$categorieName] ?? 0) + $record->delai_traitement;
    }

    return response()->json($chartData);
}

public function ActGestionProductionCategorieTwelveMonths()
{
    // Calculate the date range for the last 12 months
    $last12MonthsStart = now()->subMonths(11)->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Retrieve data for the chart using Eloquent relationships
    $actGestionData = Production::with('act_gestions')
        ->whereBetween('date_remise', [$last12MonthsStart, $currentMonthEnd])
        ->whereNotNull('delai_traitement')
        ->get(['act_gestion_id', 'delai_traitement']);

    // Initialize an array to store the organized data
    $chartData = [];

    foreach ($actGestionData as $record) {
        $categorieName = optional($record->act_gestions)->categorie ?? 'Unknown';

        // Increment the count for each category
        $chartData[$categorieName] = ($chartData[$categorieName] ?? 0) + 1;
    }

    return response()->json($chartData);
}

public function gestionProductionCategorieAverageCurrentMonth()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Retrieve data for the chart using Eloquent relationships
    $actGestionData = Production::with('act_gestions')
        ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
        ->whereNotNull('delai_traitement')
        ->get(['act_gestion_id', 'delai_traitement']);

    // Initialize an array to store the organized data
    $chartData = [];

    foreach ($actGestionData as $record) {
        $categorieName = optional($record->act_gestions)->categorie ?? 'Unknown';

        // Increment the count for each category
        $chartData[$categorieName]['count'] = ($chartData[$categorieName]['count'] ?? 0) + 1;

        // Add delai_traitement to the total for each category
        $chartData[$categorieName]['total'] = ($chartData[$categorieName]['total'] ?? 0) + $record->delai_traitement;
    }

    // Calculate the average for each category
    foreach ($chartData as $categorieName => $data) {
        $chartData[$categorieName]['average'] = $data['count'] > 0 ? $data['total'] / $data['count'] : 0;
    }

    return response()->json($chartData);
}
}
