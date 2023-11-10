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
    // public function showProductionDetails()
    // {
    //     $data = $this->getCcByActeGestionGproduction();

    //     $dataS = $this->getCcByActeGestionGproductionSortie();

    //     $dataN = $this->getCcByActeGestionGproductionInstance();

    //     return view('production.production-details', $data, $dataS, $dataN );
    // }


    // start function get the entries ===================
    public function getProductionChartDateRemise()
    {

        // Calculate the date range for the last month
        // $lastMonthStart = Carbon::now()->subMonths(2)->startOfMonth();
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
    // end function get the entries ===================

    // start function get the outing ===================
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

    // end function get the outing ===================

    // start function get the instances ===================
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

    // end function get the instances ===================



    public function calculateMeanDelaiTraitement()
    {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate the mean delai_traitement for the current month
        $meanDelaiCurrentMonth = Production::whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('date_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months
        $meanDelaiLast12Months = Production::whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('date_traitement')
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
                ->whereYear('date_remise', now()->year)
                ->count();

            $dateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', now()->month)
                ->whereYear('date_traitement', now()->year)
                ->count();

            $dateRemiseCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereMonth('date_remise', now()->month)
                ->whereYear('date_remise', now()->year)
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
                ->whereDate('date_remise', '>=', now()->subMonths(12))  // Modified condition
                ->count();

            $dateTraitementCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereDate('date_traitement', '>=', now()->subMonths(12))  // Modified condition
                ->count();

            $dateRemiseCount[] = Production::where('charge_compte_id', $chargeCompteId)
                ->whereDate('date_remise', '>=', now()->subMonths(12))  // Modified condition
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
           // Get all charge comptes
    $chargeComptes = ChargeCompte::all();

    // Get unique charge_compte_ids from Production
    $chargeCompteIds = Production::distinct('charge_compte_id')->pluck('charge_compte_id');

    // Initialize arrays to store mean delai_traitement values and charge compte names
    $meanDelaiTraitementCurrentMonth = [];
    $meanDelaiTraitementLast12Months = [];
    $chargeCompteNames = [];

    foreach ($chargeCompteIds as $chargeCompteId) {
        // Calculate date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth(); // Adjusted to include the current month
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate mean delai_traitement for the current month and charge_compte_id
        $meanCurrentMonth = Production::where('charge_compte_id', $chargeCompteId)
            ->whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('date_traitement')
            ->avg('delai_traitement');

        // Calculate mean delai_traitement for the last 12 months and charge_compte_id
        $meanLast12Months = Production::where('charge_compte_id', $chargeCompteId)
            ->whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('date_traitement')
            ->avg('delai_traitement');

        // Store mean values in arrays, default to 0 if null
        $meanDelaiTraitementCurrentMonth[$chargeCompteId] = $meanCurrentMonth ?? 0;
        $meanDelaiTraitementLast12Months[$chargeCompteId] = $meanLast12Months ?? 0;

        // Get charge compte by id and store its name in the array
        $chargeCompte = $chargeComptes->find($chargeCompteId);
        $chargeCompteNames[$chargeCompteId] = $chargeCompte ? $chargeCompte->nom : null;
    }

    // Return data as JSON with charge compte ids, names, and mean values
    return response()->json([
        'chargeCompteIds' => $chargeCompteIds,
        'chargeCompteNames' => $chargeCompteNames,
        'meanDelaiTraitementCurrentMonth' => $meanDelaiTraitementCurrentMonth,
        'meanDelaiTraitementLast12Months' => $meanDelaiTraitementLast12Months,
    ]);

    }




    // public function getTotalActGestionByCategoryMonth()
    // {
    //     // Calculate the date range for the current month
    //     $currentMonthStart = now()->startOfMonth();
    //     $currentMonthEnd = now()->endOfMonth();

    //     // Join 'act_gestions' table with 'productions' and filter by date range
    //     $result = DB::table('act_gestions')
    //         ->leftJoin('productions', 'act_gestions.id', '=', 'productions.act_gestion_id')
    //         ->whereBetween('productions.date_remise', [$currentMonthStart, $currentMonthEnd])
    //         ->select('act_gestions.categorie', DB::raw('count(*) as total'))
    //         ->groupBy('act_gestions.categorie')
    //         ->get();

    //     // Transform the result into an associative array
    //     $chartData = $result->pluck('total', 'categorie')->toArray();

    //     return response()->json($chartData);
    // }
    public function getTotalActGestionByCategoryMonth()
    {
        // Get all categories from the 'actes_gestion_production_categorie' table
        $categories = DB::table('actes_gestion_production_categorie')->pluck('categorie_name');

        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Initialize arrays to store counts for each category
        $entryCounts = [];
        $outgoingCounts = [];
        $instanceCounts = [];

        // Loop through each category
        foreach ($categories as $category) {
            // Count entries for the current category and date range
            $entryCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd]);
            })
                ->count();

            // Count outings for the current category and date range
            $outgoingCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNotNull('date_traitement')
                    ->whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd]);
            })
                ->count();

            // Count instances for the current category and date range when date_traitement is null
            $instanceCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNull('date_traitement')
                    ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd]);
            })
                ->count();
        }

        // Return data as JSON
        return response()->json([
            'categories' => $categories,
            'entryCounts' => $entryCounts,
            'outgoingCounts' => $outgoingCounts,
            'instanceCounts' => $instanceCounts,
        ]);
    }


    public function getTotalActGestionByCategoryTwelveMonths()
    {
        // Get all categories from the 'actes_gestion_production_categorie' table
        $categories = DB::table('actes_gestion_production_categorie')->pluck('categorie_name');

        // Calculate the date range for the last 12 months, including the last month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Initialize arrays to store counts for each category
        $entryCounts = [];
        $outgoingCounts = [];
        $instanceCounts = [];

        // Loop through each category
        foreach ($categories as $category) {
            // Count entries for the current category and date range
            $entryCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereBetween('date_remise', [$last12MonthsStart, $currentMonthEnd]);
            })
                ->count();

            // Count outings for the current category and date range
            $outgoingCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNotNull('date_traitement')
                    ->whereBetween('date_traitement', [$last12MonthsStart, $currentMonthEnd]);
            })
                ->count();

            // Count instances for the current category and date range when date_traitement is null
            $instanceCounts[] = Production::whereHas('act_gestions', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNull('date_traitement')
                    ->whereBetween('date_remise', [$last12MonthsStart, $currentMonthEnd]);
            })
                ->count();
        }

        // Return data as JSON
        return response()->json([
            'categories' => $categories,
            'entryCounts' => $entryCounts,
            'outgoingCounts' => $outgoingCounts,
            'instanceCounts' => $instanceCounts,
        ]);
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
    $result = DB::table('actes_gestion_production_categorie') // Changed to the correct table
    ->leftJoin('act_gestions', 'actes_gestion_production_categorie.categorie_name', '=', 'act_gestions.categorie') // Join with the right column
    ->leftJoin('productions', 'act_gestions.id', '=', 'productions.act_gestion_id')
    ->whereBetween('productions.date_traitement', [$startDate, $endDate])
    ->whereNotNull('productions.date_traitement') // Ensure delai_traitement is not null
    ->select('actes_gestion_production_categorie.categorie_name', DB::raw('avg(productions.delai_traitement) as average'))
    ->groupBy('actes_gestion_production_categorie.categorie_name')
    ->get();

// Transform the result into an associative array
$averageData = $result->pluck('average', 'categorie_name')->toArray();

return $averageData;

    }

    public function getCcByActeGestionGproduction()
    { // Get the unique categories
        $categories = DB::table('actes_gestion_production_categorie')->pluck('categorie_name');
    
        // Get unique charge_compte_ids
        $chargeCompteIds = ChargeCompte::pluck('id');
    
        // Initialize an array to store the data
        $data = [];
    
        // Loop through each charge_compte_id
        foreach ($chargeCompteIds as $chargeCompteId) {
            // Get the corresponding charge_compte_name
            $chargeCompte = ChargeCompte::find($chargeCompteId);
            $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';
    
            // Initialize an array to store data for each charge_compte_id
            $rowData = [
                'charge_compte_id' => $chargeCompteId,
                'charge_compte_name' => $chargeCompteName,
            ];
    
            // Loop through each category
            foreach ($categories as $category) {
                // Get the count of entries for the current charge_compte_id, category, and last 12 months
                $count = Production::where('charge_compte_id', $chargeCompteId)
                    ->whereHas('act_gestions', function ($query) use ($category) {
                        $query->where('categorie', $category);
                    })
                    ->where('date_remise', '>=', now()->subMonths(12)->startOfMonth())
                    ->where('date_remise', '<=', now()->endOfMonth())
                    ->count();
    
                // Store the count in the row data array
                $rowData[$category] = $count;
            }
    
            // Add the row data to the main data array
            $data[] = $rowData;
        }
    
        // Return the result with unique categories and organized data
        return ['categories' => $categories, 'data' => $data];
}

    public function getCcByActeGestionGproductionSortie()
    {
      // Get the unique categories
    $categories = DB::table('actes_gestion_production_categorie')->pluck('categorie_name');

    // Get unique charge_compte_ids
    $chargeCompteIds = ChargeCompte::pluck('id');

    // Initialize an array to store the data
    $dataS = [];

    // Loop through each charge_compte_id
    foreach ($chargeCompteIds as $chargeCompteId) {
        // Get the corresponding charge_compte_name
        $chargeCompte = ChargeCompte::find($chargeCompteId);
        $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';

        // Initialize an array to store data for each charge_compte_id
        $rowData = [
            'charge_compte_id' => $chargeCompteId,
            'charge_compte_name' => $chargeCompteName,
        ];

        // Loop through each category
        foreach ($categories as $category) {
            // Get the count of entries for the current charge_compte_id, category, and last 12 months
            $count = Production::where('charge_compte_id', $chargeCompteId)
                ->whereHas('act_gestions', function ($query) use ($category) {
                    $query->where('categorie', $category);
                })
                ->where('date_traitement', '>=', now()->subMonths(12)->startOfMonth())
                ->where('date_traitement', '<=', now()->endOfMonth())
                ->count();

            // Store the count in the row data array
            $rowData[$category] = $count;
        }

        // Add the row data to the main data array
        $dataS[] = $rowData;
    }

    return ['categories' => $categories, 'dataS' => $dataS];
    }

    public function getCcByActeGestionGproductionInstance()
    {
         // Get the unique categories from the database
    $categories = DB::table('actes_gestion_production_categorie')->pluck('categorie_name');

    // Get unique charge_compte_ids
    $chargeCompteIds = ChargeCompte::pluck('id');

    // Initialize an array to store the data
    $dataN = [];

    // Loop through each charge_compte_id
    foreach ($chargeCompteIds as $chargeCompteId) {
        // Get the corresponding charge_compte_name
        $chargeCompte = ChargeCompte::find($chargeCompteId);
        $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';

        // Initialize an array to store data for each charge_compte_id
        $rowData = [
            'charge_compte_id' => $chargeCompteId,
            'charge_compte_name' => $chargeCompteName,
        ];

        // Loop through each category
        foreach ($categories as $category) {
            // Get the count of entries for the current charge_compte_id, category, and last 12 months
            $count = Production::where('charge_compte_id', $chargeCompteId)
                ->whereHas('act_gestions', function ($query) use ($category) {
                    $query->where('categorie', $category);
                })
                ->whereNull('date_traitement')
                ->where('date_remise', '>=', now()->subMonths(12)->startOfMonth())
                ->where('date_remise', '<=', now()->endOfMonth())
                ->count();

            // Store the count in the row data array
            $rowData[$category] = $count;
        }

        // Add the row data to the main data array
        $dataN[] = $rowData;
    }

    return ['categories' => $categories, 'dataN' => $dataN];
    }

    public function showProductionDetails()
    {
        $data = $this->getCcByActeGestionGproduction();

        $dataS = $this->getCcByActeGestionGproductionSortie();

        $dataN = $this->getCcByActeGestionGproductionInstance();
        $viewData = [
            'data' => $data,
            'dataS' => $dataS,
            'dataN' => $dataN,
            'categories' => $data['categories'],
            'categories' => $dataS['categories'],
            'categories' => $dataN['categories']
        ];
        return view('production.production-details', $viewData);
    }
}
