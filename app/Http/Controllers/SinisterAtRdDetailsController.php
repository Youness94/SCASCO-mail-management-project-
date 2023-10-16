<?php

namespace App\Http\Controllers;

use App\Models\ChargeCompteSinistres;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SinisterAtRdDetailsController extends Controller
{
    public function showSinisterAtRdDetails()
    {
        return view('sinistresatrd.sinistresatrd-details');
    }

    public function SinisterAtRdChartDateRemise()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = Sinistre::whereBetween('date_remise', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = Sinistre::whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function SinisterAtRdChartDateTraitement()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = Sinistre::whereBetween('date_traitement', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = Sinistre::whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function SinisterAtRdChartDateTraitementNull()
    {
        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_traitement where it's equal to null for the last month and last 12 months
        $lastMonthData = Sinistre::whereNull('date_traitement')->whereBetween('date_remise', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $last12MonthsData = Sinistre::whereNull('date_traitement')->whereBetween('date_remise', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function calculateMeanDelaiTraitementSinisterAtRd()
    {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate the mean delai_traitement for the current month
        $meanDelaiCurrentMonth = Sinistre::whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months
        $meanDelaiLast12Months = Sinistre::whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Return data as JSON
        return response()->json([
            'meanDelaiCurrentMonth' => $meanDelaiCurrentMonth,
            'meanDelaiLast12Months' => $meanDelaiLast12Months,
        ]);
    }

    // ==========  ========== //
    public function SinisterAtRdChartByChargeCompte()
    {
        // Assuming your ChargeCompte model has a 'name' attribute
        $chargeComptes = ChargeCompteSinistres::all();

        // Your existing data retrieval logic
        $chargeCompteIds = Sinistre::distinct('charge_compte_sinistre_id')->pluck('charge_compte_sinistre_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->whereMonth('date_remise', now()->month)
                ->count();

            $dateTraitementCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', now()->month)
                ->count();

            $dateRemiseCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
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

    public function SinisterAtRdChartChargeCompteTwelve()
    {
        // Assuming your ChargeCompte model has a 'name' attribute
        $chargeComptes = ChargeCompteSinistres::all();

        // Your existing data retrieval logic
        $chargeCompteIds = Sinistre::distinct('charge_compte_sinistre_id')->pluck('charge_compte_sinistre_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->whereMonth('date_remise', '>=', now()->subMonths(12)->month)  // Modified condition
                ->count();

            $dateTraitementCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', '>=', now()->subMonths(12)->month)  // Modified condition
                ->count();

            $dateRemiseCount[] = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
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

    
    public function SinisterAtRdMeanDelaiTraitementByChargeCompte()
{
    // Your existing data retrieval logic
    $chargeComptes = ChargeCompteSinistres::all(); 

    $chargeCompteIds = Sinistre::distinct('charge_compte_sinistre_id')->pluck('charge_compte_sinistre_id');

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
        $meanCurrentMonth = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
            ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months and charge_compte_id
        $meanLast12Months = Sinistre::where('charge_compte_sinistre_id', $chargeCompteId)
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

public function getTotalActGestionByCategoryMonthAtRd()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('acte_de_gestion_sinistres_at_rd')
        ->leftJoin('sinistres', 'acte_de_gestion_sinistres_at_rd.id', '=', 'sinistres.acte_de_gestion_sinistre_id')
        ->whereBetween('sinistres.date_remise', [$currentMonthStart, $currentMonthEnd])
        ->select('acte_de_gestion_sinistres_at_rd.categorie', DB::raw('count(*) as total'))
        ->groupBy('acte_de_gestion_sinistres_at_rd.categorie')
        ->get();

    // Transform the result into an associative array
    $chartData = $result->pluck('total', 'categorie')->toArray();

    return response()->json($chartData);
}

public function getTotalActGestionByCategoryTwelveMonthsAtRd()
{
    // Calculate the date range for the last twelve months
    $lastTwelveMonthsStart = now()->subMonths(12)->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('acte_de_gestion_sinistres_at_rd')
        ->leftJoin('sinistres', 'acte_de_gestion_sinistres_at_rd.id', '=', 'sinistres.acte_de_gestion_sinistre_id')
        ->whereBetween('sinistres.date_remise', [$lastTwelveMonthsStart, $currentMonthEnd])
        ->select('acte_de_gestion_sinistres_at_rd.categorie', DB::raw('count(*) as total'))
        ->groupBy('acte_de_gestion_sinistres_at_rd.categorie')
        ->get();

    // Transform the result into an associative array
    $chartData = $result->pluck('total', 'categorie')->toArray();

    return response()->json($chartData);
}

public function getAverageActGestionByCategoryAtRd()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Calculate the date range for the last 12 months
    $lastTwelveMonthsStart = now()->subMonths(12)->startOfMonth();
    $lastTwelveMonthsEnd = now()->endOfMonth();

    // Get the average for the current month
    $currentMonthAverage = $this->getAverageByCategoryAtRd($currentMonthStart, $currentMonthEnd);

    // Get the average for the last 12 months
    $lastTwelveMonthsAverage = $this->getAverageByCategoryAtRd($lastTwelveMonthsStart, $lastTwelveMonthsEnd);

    return response()->json([
        'current_month_average' => $currentMonthAverage,
        'last_twelve_months_average' => $lastTwelveMonthsAverage,
    ]);
}

private function getAverageByCategoryAtRd($startDate, $endDate)
{
    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('acte_de_gestion_sinistres_at_rd')
        ->leftJoin('sinistres', 'acte_de_gestion_sinistres_at_rd.id', '=', 'sinistres.acte_de_gestion_sinistre_id')
        ->whereBetween('sinistres.date_remise', [$startDate, $endDate])
        ->select('acte_de_gestion_sinistres_at_rd.categorie', DB::raw('avg(sinistres.acte_de_gestion_sinistre_id) as average'))
        ->groupBy('acte_de_gestion_sinistres_at_rd.categorie')
        ->get();

    // Transform the result into an associative array
    $averageData = $result->pluck('average', 'categorie')->toArray();

    return $averageData;
}
}
