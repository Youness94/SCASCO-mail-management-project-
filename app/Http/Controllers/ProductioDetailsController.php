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




public function getTotalActGestionByCategoryMonth()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('act_gestions')
        ->leftJoin('productions', 'act_gestions.id', '=', 'productions.act_gestion_id')
        ->whereBetween('productions.date_remise', [$currentMonthStart, $currentMonthEnd])
        ->select('act_gestions.categorie', DB::raw('count(*) as total'))
        ->groupBy('act_gestions.categorie')
        ->get();

    // Transform the result into an associative array
    $chartData = $result->pluck('total', 'categorie')->toArray();

    return response()->json($chartData);
}


public function getTotalActGestionByCategoryTwelveMonths()
{
    // Calculate the date range for the last twelve months
    $lastTwelveMonthsStart = now()->subMonths(12)->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('act_gestions')
        ->leftJoin('productions', 'act_gestions.id', '=', 'productions.act_gestion_id')
        ->whereBetween('productions.date_remise', [$lastTwelveMonthsStart, $currentMonthEnd])
        ->select('act_gestions.categorie', DB::raw('count(*) as total'))
        ->groupBy('act_gestions.categorie')
        ->get();

    // Transform the result into an associative array
    $chartData = $result->pluck('total', 'categorie')->toArray();

    return response()->json($chartData);
}


public function getAverageActGestionByCategory()
{
    // Calculate the date range for the current month
    $currentMonthStart = now()->startOfMonth();
    $currentMonthEnd = now()->endOfMonth();

    // Calculate the date range for the last 12 months
    $lastTwelveMonthsStart = now()->subMonths(12)->startOfMonth();
    $lastTwelveMonthsEnd = now()->endOfMonth();

    // Get the average for the current month
    $currentMonthAverage = $this->getAverageByCategory($currentMonthStart, $currentMonthEnd);

    // Get the average for the last 12 months
    $lastTwelveMonthsAverage = $this->getAverageByCategory($lastTwelveMonthsStart, $lastTwelveMonthsEnd);

    return response()->json([
        'current_month_average' => $currentMonthAverage,
        'last_twelve_months_average' => $lastTwelveMonthsAverage,
    ]);
}

private function getAverageByCategory($startDate, $endDate)
{
    // Join 'act_gestions' table with 'productions' and filter by date range
    $result = DB::table('act_gestions')
        ->leftJoin('productions', 'act_gestions.id', '=', 'productions.act_gestion_id')
        ->whereBetween('productions.date_remise', [$startDate, $endDate])
        ->select('act_gestions.categorie', DB::raw('avg(productions.act_gestion_id) as average'))
        ->groupBy('act_gestions.categorie')
        ->get();

    // Transform the result into an associative array
    $averageData = $result->pluck('average', 'categorie')->toArray();

    return $averageData;
}
}
