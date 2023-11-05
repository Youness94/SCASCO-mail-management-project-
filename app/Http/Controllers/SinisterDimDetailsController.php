<?php

namespace App\Http\Controllers;

use App\Models\ChargeCompteDim;
use App\Models\SinistreDim;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ActesGestionSinisterDimCategorie;
use App\Models\ActeGestionsDim;
use App\Models\SinistresDim;

class SinisterDimDetailsController extends Controller
{
    public function showSinisterDimDetails()
    {
        $data = $this->getCcByActeGestionGSinisterDim();

        $dataS = $this->getCcByActeGestionGSinisterDimSortie();

        $dataN = $this->getCcByActeGestionGSinisterDimInstance();
        $viewData = [
            'data' => $data,
            'dataS' => $dataS,
            'dataN' => $dataN,
            'categories' => $data['categories'],
            'categories' => $dataS['categories'],
            'categories' => $dataN['categories']
        ];

        return view('sinistresdim.sinistresdim-details', $viewData);
    }

    public function SinisterDimChartDateRemise()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = SinistreDim::whereBetween('date_remise', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = SinistreDim::whereBetween('date_remise', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function SinisterDimChartDateTraitement()
    {

        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = Carbon::now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_remise for the last month and last 12 months
        $lastMonthData = SinistreDim::whereBetween('date_traitement', [$lastMonthStart, $lastMonthEnd])->count();
        $last12MonthsData = SinistreDim::whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function SinisterDimChartDateTraitementNull()
    {
        // Calculate the date range for the last month
        $lastMonthStart = Carbon::now()->startOfMonth();
        $lastMonthEnd = Carbon::now()->endOfMonth();

        // Fetch count of date_traitement where it's equal to null for the last month and last 12 months
        $lastMonthData = SinistreDim::whereNull('date_traitement')->whereBetween('date_remise', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $last12MonthsData = SinistreDim::whereNull('date_traitement')->whereBetween('date_remise', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])->count();

        // Return data as JSON
        return response()->json([
            'lastMonthData' => $lastMonthData,
            'last12MonthsData' => $last12MonthsData,
        ]);
    }

    public function calculateMeanDelaiTraitementSinisterDim()
    {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Calculate the date range for the last 12 months, including the current month
        $last12MonthsStart = now()->subMonths(12)->startOfMonth();
        $last12MonthsEnd = now()->endOfMonth();

        // Calculate the mean delai_traitement for the current month
        $meanDelaiCurrentMonth = SinistreDim::whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Calculate the mean delai_traitement for the last 12 months
        $meanDelaiLast12Months = SinistreDim::whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])
            ->whereNotNull('delai_traitement')
            ->avg('delai_traitement');

        // Return data as JSON
        return response()->json([
            'meanDelaiCurrentMonth' => $meanDelaiCurrentMonth,
            'meanDelaiLast12Months' => $meanDelaiLast12Months,
        ]);
    }

    // ==========  ========== //
    public function SinisterDimChartByChargeCompte()
    {

        $chargeComptes = ChargeCompteDim::all();

        $chargeCompteIds = SinistreDim::distinct('charge_compte_dim_id')->pluck('charge_compte_dim_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->whereMonth('date_remise', now()->month)
                ->count();

            $dateTraitementCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->whereMonth('date_traitement', now()->month)
                ->count();

            $dateRemiseCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereMonth('date_remise', now()->month)
                ->count();


            $chargeCompte = $chargeComptes->find($chargeCompteId);
            $chargeCompteNames[$chargeCompteId] = $chargeCompte ? $chargeCompte->nom : null;
        }


        return response()->json([
            'chargeCompteIds' => $chargeCompteIds,
            'chargeCompteNames' => $chargeCompteNames,
            'nullDateTraitementCount' => $nullDateTraitementCount,
            'dateTraitementCount' => $dateTraitementCount,
            'dateRemiseCount' => $dateRemiseCount,
        ]);
    }



    public function SinisterDimChartChargeCompteTwelve()
    {




        $chargeComptes = ChargeCompteDim::all();


        $chargeCompteIds = SinistreDim::distinct('charge_compte_dim_id')->pluck('charge_compte_dim_id');

        $nullDateTraitementCount = [];
        $dateTraitementCount = [];
        $dateRemiseCount = [];
        $chargeCompteNames = [];

        foreach ($chargeCompteIds as $chargeCompteId) {
            $nullDateTraitementCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereNull('date_traitement')
                ->where('date_remise', '>=', now()->subMonths(12))  // Adjusted condition
                ->count();

            $dateTraitementCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereNotNull('date_traitement')
                ->where('date_traitement', '>=', now()->subMonths(12))  // Adjusted condition
                ->count();

            $dateRemiseCount[] = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->where('date_remise', '>=', now()->subMonths(12))  // Adjusted condition
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


    public function SinisterDimMeanDelaiTraitementByChargeCompte()
    {

        $chargeComptes = ChargeCompteDim::all();

        $chargeCompteIds = SinistreDim::distinct('charge_compte_dim_id')->pluck('charge_compte_dim_id');

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
            $meanCurrentMonth = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd])
                ->whereNotNull('date_traitement')
                ->avg('delai_traitement');

            // Calculate the mean delai_traitement for the last 12 months and charge_compte_id
            $meanLast12Months = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                ->whereBetween('date_traitement', [$last12MonthsStart, $last12MonthsEnd])
                ->whereNotNull('date_traitement')
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

    // ====

    public function getTotalActGestionByCategoryMonthDim()
    {
        // Get all categories from the 'actes_gestion_production_categorie' table
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->pluck('categorie_name');

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
            $entryCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereBetween('date_remise', [$currentMonthStart, $currentMonthEnd]);
            })
                ->count();

            // Count outings for the current category and date range
            $outgoingCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNotNull('date_traitement')
                    ->whereBetween('date_traitement', [$currentMonthStart, $currentMonthEnd]);
            })
                ->count();

            // Count instances for the current category and date range when date_traitement is null
            $instanceCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $currentMonthStart, $currentMonthEnd) {
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

    public function getTotalActGestionByCategoryTwelveMonthsDim()
    {
        // Get all categories from the 'actes_gestion_production_categorie' table
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->pluck('categorie_name');

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
            $entryCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereBetween('date_remise', [$last12MonthsStart, $currentMonthEnd]);
            })
                ->count();

            // Count outings for the current category and date range
            $outgoingCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
                $query->where('categorie', $category)
                    ->whereNotNull('date_traitement')
                    ->whereBetween('date_traitement', [$last12MonthsStart, $currentMonthEnd]);
            })
                ->count();

            // Count instances for the current category and date range when date_traitement is null
            $instanceCounts[] = SinistreDim::whereHas('acte_de_gestion_dim', function ($query) use ($category, $last12MonthsStart, $currentMonthEnd) {
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
    private function getAverageByCategoryDim($startDate, $endDate)
    {
        $result = ActesGestionSinisterDimCategorie::select(
                'actes_gestion_sinister_dim_categorie.categorie_name',
                DB::raw('avg(sinistres_dim.delai_traitement) as average')
            )
            ->leftJoin('acte_gestions_dim', 'actes_gestion_sinister_dim_categorie.categorie_name', '=', 'acte_gestions_dim.categorie')
            ->leftJoin('sinistres_dim', 'acte_gestions_dim.id', '=', 'sinistres_dim.acte_gestion_dim_id')
            ->whereBetween('sinistres_dim.date_traitement', [$startDate, $endDate])
            ->whereNotNull('sinistres_dim.date_traitement')
            ->groupBy('actes_gestion_sinister_dim_categorie.categorie_name')
            ->get();
    
        $averageData = $result->pluck('average', 'categorie_name')->toArray();
    
        return $averageData;
    }
    
    public function getAverageActGestionByCategoryDim()
    {
        // Calculate the date range for the current month
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
    
        // Calculate the date range for the last 12 months
        $lastTwelveMonthsStart = now()->subMonths(12)->startOfMonth();
        $lastTwelveMonthsEnd = now()->endOfMonth();
    
        // Get the average for the current month
        $currentMonthAverage = $this->getAverageByCategoryDim($currentMonthStart, $currentMonthEnd);
    
        // Get the average for the last 12 months
        $lastTwelveMonthsAverage = $this->getAverageByCategoryDim($lastTwelveMonthsStart, $lastTwelveMonthsEnd);
    
        return response()->json([
            'current_month_average' => $currentMonthAverage,
            'last_twelve_months_average' => $lastTwelveMonthsAverage,
        ]);
    }


    public function getCcByActeGestionGSinisterDim()
    {
        // Get the unique categories from the database
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->pluck('categorie_name');

        // Get unique charge_compte_ids
        $chargeCompteIds = ChargeCompteDim::pluck('id');

        // Initialize an array to store the data
        $data = [];

        // Loop through each charge_compte_id
        foreach ($chargeCompteIds as $chargeCompteId) {
            // Get the corresponding charge_compte_name
            $chargeCompte = ChargeCompteDim::find($chargeCompteId);
            $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';

            // Initialize an array to store data for each charge_compte_id
            $rowData = [
                'charge_compte_dim_id' => $chargeCompteId,
                'charge_compte_dim_name' => $chargeCompteName,
            ];

            // Loop through each category
            foreach ($categories as $category) {
                // Get the count of entries for the current charge_compte_id, category, and date_remise within the last twelve months
                $count = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                    ->whereHas('acte_de_gestion_dim', function ($query) use ($category) {
                        $query->where('categorie', $category);
                    })
                    ->whereBetween('date_remise', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])
                    ->count();

                // Store the count in the row data array
                $rowData[$category] = $count;
            }

            // Add the row data to the main data array
            $data[] = $rowData;
        }

        return ['categories' => $categories, 'data' => $data];
    }

    public function getCcByActeGestionGSinisterDimSortie()
    {
        // Get the unique categories from the database
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->pluck('categorie_name');

        // Get unique charge_compte_ids
        $chargeCompteIds = ChargeCompteDim::pluck('id');

        // Initialize an array to store the data
        $dataS = [];

        // Loop through each charge_compte_id
        foreach ($chargeCompteIds as $chargeCompteId) {
            // Get the corresponding charge_compte_name
            $chargeCompte = ChargeCompteDim::find($chargeCompteId);
            $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';

            // Initialize an array to store data for each charge_compte_id
            $rowData = [
                'charge_compte_dim_id' => $chargeCompteId,
                'charge_compte_dim_name' => $chargeCompteName,
            ];

            // Loop through each category
            foreach ($categories as $category) {
                // Get the count of entries for the current charge_compte_id, category, and date_traitement when not null within the last twelve months
                $count = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                    ->whereHas('acte_de_gestion_dim', function ($query) use ($category) {
                        $query->where('categorie', $category);
                    })
                    ->whereNotNull('date_traitement')
                    ->whereBetween('date_traitement', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])
                    ->count();

                // Store the count in the row data array
                $rowData[$category] = $count;
            }

            // Add the row data to the main data array
            $dataS[] = $rowData;
        }

        return ['categories' => $categories, 'dataS' => $dataS];
    }

    public function getCcByActeGestionGSinisterDimInstance()
    {

        // Get the unique categories from the database
        $categories = DB::table('actes_gestion_sinister_dim_categorie')->pluck('categorie_name');

        // Get unique charge_compte_ids
        $chargeCompteIds = ChargeCompteDim::pluck('id');

        // Initialize an array to store the data
        $dataN = [];

        // Loop through each charge_compte_id
        foreach ($chargeCompteIds as $chargeCompteId) {
            // Get the corresponding charge_compte_name
            $chargeCompte = ChargeCompteDim::find($chargeCompteId);
            $chargeCompteName = $chargeCompte ? $chargeCompte->nom : 'Unknown';

            // Initialize an array to store data for each charge_compte_id
            $rowData = [
                'charge_compte_dim_id' => $chargeCompteId,
                'charge_compte_dim_name' => $chargeCompteName,
            ];

            // Loop through each category
            foreach ($categories as $category) {
                // Get the count of entries for the current charge_compte_id, category, and null date_traitement within the last twelve months
                $count = SinistreDim::where('charge_compte_dim_id', $chargeCompteId)
                    ->whereHas('acte_de_gestion_dim', function ($query) use ($category) {
                        $query->where('categorie', $category);
                    })
                    ->whereNull('date_traitement')
                    ->whereBetween('created_at', [now()->subMonths(12)->startOfMonth(), now()->endOfMonth()])
                    ->count();

                // Store the count in the row data array
                $rowData[$category] = $count;
            }

            // Add the row data to the main data array
            $dataN[] = $rowData;
        }

        return ['categories' => $categories, 'dataN' => $dataN];
    }
}
