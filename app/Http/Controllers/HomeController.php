<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\Sinistre;
use App\Models\SinistreDim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    /** home dashboard */
    public function index()
    {
        $productions = Production::with('branches', 'compagnies', 'act_gestions', 'charge_comptes')->get();
        $sinistres_dim = SinistreDim::with('branches_dim', 'compagnies', 'acte_de_gestion_dim', 'charge_compte_dim')->get();
        $sinistres = Sinistre::with('branches_sinistres', 'compagnies', 'acte_de_gestion_sinistres', 'charge_compte_sinistres')->get();
        $totalProduction = Production::count(); 
        $totalSinistreDim = SinistreDim::count();
        $totalSinistreAt_Rd = Sinistre::count();
        $users = User::latest()->get();
        // $users = User::all();
        return view('dashboard.accueil', compact('totalProduction', 'totalSinistreDim', 'totalSinistreAt_Rd', 'sinistres_dim', 'sinistres', 'productions','users'));
    }

    // =============
    public function fetchMonthlyProductionData()
    {
        $production = Production::selectRaw('MONTH(date_reception) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(date_reception)')
            ->orderByRaw('MONTH(date_reception)')
            ->get();
    
        return response()->json($production);
    }
    public function fetchMonthlySinistresDimData()
    {
        $sinistres_dim = SinistreDim::selectRaw('MONTH(date_reception) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(date_reception)')
            ->orderByRaw('MONTH(date_reception)')
            ->get();
    
        return response()->json($sinistres_dim);
    }
    public function fetchMonthlySinistresAtRdData()
    {
        $sinistres_at_rd = Sinistre::selectRaw('MONTH(date_reception) as month, COUNT(*) as count')
            ->groupByRaw('MONTH(date_reception)')
            ->orderByRaw('MONTH(date_reception)')
            ->get();
    
        return response()->json($sinistres_at_rd);
    }

    public function pieChart()
{
    $productionCount = Production::count();
    $sinistreCount = Sinistre::count();
    $sinistreDimCount = SinistreDim::count();

    return response()->json([
        'labels' => ['Productions', 'Sinistres AT&RD', 'Sinistres DIM'],
        'values' => [$productionCount, $sinistreCount, $sinistreDimCount], // Changed 'data' to 'values'
    ]);
}
    // ===================




    /** profile user */
    public function userProfile()
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        return view('dashboard.profile', compact('users'));
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }
}
