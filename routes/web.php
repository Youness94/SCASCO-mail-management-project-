<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TypeFormController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DepartmentController;


use App\Http\Controllers\ActeDeGestionSinistresAtRdController;
use App\Http\Controllers\ActeGestionDimController;
use App\Http\Controllers\ActGestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\BrancheDimController;
use App\Http\Controllers\BranchSinistresAtRdController;
use App\Http\Controllers\ChargeCompteController;
use App\Http\Controllers\ChargeCompteDimController;
use App\Http\Controllers\ChargeCompteSinistresController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SinistreDimController;
use App\Http\Controllers\SinistresAtRDController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
if (!function_exists('set_active')) {
    function set_active($route) {
        if( is_array( $route ) ){
            return in_array(Request::path(), $route) ? 'active' : '';
        }
        return Request::path() == $route ? 'active' : '';
    }
}


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('accueil',function()
    {
        return view('accueil');
    });
    Route::get('accueil',function()
    {
        return view('accueil');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();

// ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/change/password', 'changePassword')->name('change/password');
});

// ----------------------------- register -------------------------//

Route::middleware(['auth', 'role:responsable'])->group(function(){

});// end group admin middleware


// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/accueil', 'index')->middleware('auth')->name('accueil');
    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');

    Route::get('/fetch-monthly-production-data', 'fetchMonthlyProductionData')->middleware('auth')->name('fetch.production.data');
    Route::get('/fetch-monthly-sinistres-dim-data', 'fetchMonthlySinistresDimData')->middleware('auth')->name('fetch.sinistresdim.data');
    Route::get('/fetch-monthly-sinistres-at-rd-data', 'fetchMonthlySinistresAtRdData')->middleware('auth')->name('fetch.sinistresatrd.data');
    Route::get('/pie-chart', 'pieChart')->middleware('auth')->name('pie.chart');
});

// ----------------------------- user controller -------------------------//


// ------------------------ setting -------------------------------//
// Route::controller(Setting::class)->group(function () {
//     Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
// });


// =============

Route::group(['middleware' => 'checkRole:Admin'], function () {
    // Routes accessible only for Admin
    // Add your routes here
});

Route::controller(UserManagementController::class)->group(function () {
Route::get('/update-profile',  'profileUpdateForm')->middleware('auth')->name('update.profile.form');
Route::post('/update-profile', 'updateProfile')->middleware('auth')->name('update.profile');
Route::post('change/password', 'changePassword')->middleware('auth')->name('change/password');
});


Route::group(['middleware' => 'checkRole:Super Admin'], function () {
    

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');    
    });


    Route::controller(UserManagementController::class)->group(function () {
        Route::get('liste/utilisateurs', 'index')->middleware('auth')->name('all.users');
        Route::get('/ajouter/utilisateur', 'userAdd')->name('add.user');
        Route::post('/store/utilisateur', 'userStore')->name('store.user');
        Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
        Route::post('user/update', 'userUpdate')->name('user/update');
        Route::post('user/delete', 'userDelete')->name('user/delete');
       
    });
   // ------------------------ branches -------------------------------//

 Route::controller(BrancheController::class)->group(function(){
    Route::get('/tous/branches-production', 'AllBranches')->name('all.branches');
    Route::get('/ajouter/branche-production', 'AddBranche')->name('add.branche');
    Route::post('/store/branche-production', 'StoreBranche')->name('store.branche');
    Route::get('/modifier/branche-production/{id}', 'EditBranche')->name('edit.branche');
    Route::post('/update/branche-production', 'UpdateBranche')->name('update.branche');
    Route::get('/delete/branche-production/{id}', 'DeleteBranche')->name('delete.branche');
});

// ------------------------ compagnies -------------------------------//

Route::controller(CompagnieController::class)->group(function(){
    Route::get('/tous/compagnies', 'AllCompagnies')->name('all.compagnies');
    Route::get('/ajouter/compagnie', 'AddCompagnie')->name('add.compagnie');
    Route::post('/store/compagnie', 'StoreCompagnie')->name('store.compagnie');
    Route::get('/modifier/compagnie/{id}', 'EditCompagnie')->name('edit.compagnie');
    Route::post('/update/compagnie', 'UpdateCompagnie')->name('update.compagnie');
    Route::get('/delete/compagnie/{id}', 'DeleteCompagnie')->name('delete.compagnie');
});

// ------------------------ acte gestions -------------------------------//

Route::controller(ActGestionController::class)->group(function(){
    Route::get('/tous/acte-gestions-production', 'AllActGestions')->name('all.act_gestions');
    Route::get('/ajouter/acte-gestion-production', 'AddActGestion')->name('add.act_gestion');
    Route::post('/store/acte-gestion-production', 'StoreActGestion')->name('store.act_gestion');
    Route::get('/modifier/acte-gestion-production/{id}', 'EditActGestion')->name('edit.act_gestion');
    Route::post('/update/acte-gestion-production', 'UpdateActGestion')->name('update.act_gestion');
    Route::get('/delete/acte-gestion-production/{id}', 'DeleteActGestion')->name('delete.act_gestion');
});

 // ------------------------ charge comptes -------------------------------//

Route::controller(ChargeCompteController::class)->group(function(){
    Route::get('/tous/charge-comptes-production', 'AllChargeComptes')->name('all.charge_comptes');
    Route::get('/ajouter/charge-compte-production', 'AddChargeCompte')->name('add.charge_compte');
    Route::post('/store/charge-compte-production', 'StoreChargeCompte')->name('store.charge_compte');
    Route::get('/modifier/charge-compte-production/{id}', 'EditChargeCompte')->name('edit.charge_compte');
    Route::post('/update/charge-compte-production', 'UpdateChargeCompte')->name('update.charge_compte');
    Route::get('/delete/charge-compte-production/{id}', 'DeleteChargeCompte')->name('delete.charge_compte');
});

 // ================ Sinistres AT&RD Routes ================== //

// ------------------------ branches -------------------------------//

Route::controller(BranchSinistresAtRdController::class)->group(function(){
    Route::get('/tous/branches-sinistres-at-rd', 'AllBranchesSinistresAtRd')->name('all.branches.sinistres');
    Route::get('/ajouter/branche-sinistre-at-rd', 'AddBrancheSinistresAtRd')->name('add.branche.sinistre');
    Route::post('/store/branche-sinistre-at-rd', 'StoreBrancheSinistresAtRd')->name('store.branche.sinistre');
    Route::get('/modifier/branche-sinistre-at-rd/{id}', 'EditBrancheSinistresAtRd')->name('edit.branche.sinistre');
    Route::post('/update/branche-sinistre-at-rd', 'UpdateBrancheSinistresAtRd')->name('update.branche.sinistre');
    Route::get('/delete/branche-sinistre-at-rd/{id}', 'DeleteBrancheSinistresAtRd')->name('delete.branche.sinistre');
});


// ------------------------ acte gestions -------------------------------//

Route::controller(ActeDeGestionSinistresAtRdController::class)->group(function(){
    Route::get('/tous/acte-gestion-sinistres-at-rd', 'AllActeDeGestionSinistresAtRd')->name('all.acte.gestion.sinistres');
    Route::get('/ajouter/acte-gestion-sinistre-at-rd', 'AddActeDeGestionSinistresAtRd')->name('add.acte.gestion.sinistre');
    Route::post('/store/acte-gestion-sinistre-at-rd', 'StoreActeDeGestionSinistresAtRd')->name('store.acte.gestion.sinistre');
    Route::get('/modifier/acte-gestion-sinistre-at-rd/{id}', 'EditActeDeGestionSinistresAtRd')->name('edit.acte.gestion.sinistre');
    Route::post('/update/acte-gestion-sinistre-at-rd', 'UpdateActeDeGestionSinistresAtRd')->name('update.acte.gestion.sinistre');
    Route::get('/delete/acte-gestion-sinistre-at-rd/{id}', 'DeleteActeDeGestionSinistresAtRd')->name('delete.acte.gestion.sinistre');
});

 // ------------------------ charge comptes -------------------------------//

 Route::controller(ChargeCompteSinistresController::class)->group(function(){
    Route::get('/tous/charge-compte-sinistres-at-rd', 'AllChargeCompteSinistres')->name('all.charge.compte.sinistres');
    Route::get('/ajouter/charge-compte-sinistre-at-rd', 'AddChargeCompteSinistre')->name('add.charge.compte.sinistre');
    Route::post('/store/charge-compte-sinistre-at-rd', 'StoreChargeCompteSinistre')->name('store.charge.compte.sinistre');
    Route::get('/modifier/charge-compte-sinistre-at-rd/{id}', 'EditChargeCompteSinistre')->name('edit.charge.compte.sinistre');
    Route::post('/update/charge_compte_sinistre-at-rd', 'UpdateChargeCompteSinistre')->name('update.charge.compte.sinistre');
    Route::get('/delete/charge_compte_sinistre-at-rd/{id}', 'DeleteChargeCompteSinistre')->name('delete.charge.compte.sinistre');
});

  // ================ Sinistres DIM Routes ================== //

// ------------------------ branches -------------------------------//

Route::controller(BrancheDimController::class)->group(function(){
    Route::get('/tous/branches-sinistre-dim', 'AllBranchesSinistresDim')->name('all.branches.sinistres.dim');
    Route::get('/ajouter/branche-sinistre-dim', 'AddBranchesSinistresDim')->name('add.branche.sinistre.dim');
    Route::post('/store/branche-sinistre-dim', 'StoreBranchesSinistresDim')->name('store.branche.sinistre.dim');
    Route::get('/modifier/branche-sinistre-dim/{id}', 'EditBranchesSinistresDim')->name('edit.branche.sinistre.dim');
    Route::post('/update/branche-sinistre-dim', 'UpdateBranchesSinistresDim')->name('update.branche.sinistre.dim');
    Route::get('/delete/branche-sinistre-dim/{id}', 'DeleteBranchesSinistresDim')->name('delete.branche.sinistre.dim');
});

// ------------------------ acte gestions -------------------------------//

Route::controller(ActeGestionDimController::class)->group(function(){
    Route::get('/tous/acte-gestion-sinistres-dim', 'AllActeDeGestionSinistresDim')->name('all.acte.gestion.sinistres.dim');
    Route::get('/ajouter/acte-gestion-sinistre-dim', 'AddActeDeGestionSinistreDim')->name('add.acte.gestion.sinistre.dim');
    Route::post('/store/acte-gestion-sinistre-dim', 'StoreActeDeGestionSinistreDim')->name('store.acte.gestion.sinistre.dim');
    Route::get('/modifier/acte-gestion-sinistre-dim/{id}', 'EditActeDeGestionSinistreDim')->name('edit.acte.gestion.sinistre.dim');
    Route::post('/update/acte-gestion-sinistre-dim', 'UpdateActeDeGestionSinistreDim')->name('update.acte.gestion.sinistre.dim');
    Route::get('/delete/acte-gestion-sinistre-dim/{id}', 'DeleteActeDeGestionSinistreDim')->name('delete.acte.gestion.sinistre.dim');
});

 // ------------------------ charge comptes -------------------------------//

 Route::controller(ChargeCompteDimController::class)->group(function(){
    Route::get('/tous/charge-compte-sinistres-dim', 'AllChargeCompteDim')->name('all.charge.compte.sinistres.dim');
    Route::get('/ajouter/charge-compte-sinistre-dim', 'AddChargeCompteDim')->name('add.charge.compte.sinistre.dim');
    Route::post('/store/charge-compte-sinistre-dim', 'StoreChargeCompteDim')->name('store.charge.compte.sinistre.dim');
    Route::get('/modifier/charge-compte-sinistre-dim/{id}', 'EditChargeCompteDim')->name('edit.charge.compte.sinistre.dim');
    Route::post('/update/charge-compte-sinistre-dim', 'UpdateChargeCompteDim')->name('update.charge.compte.sinistre.dim');
    Route::get('/delete/charge-compte-sinistre-dim/{id}', 'DeleteChargeCompteDim')->name('delete.charge.compte.sinistre.dim');
});

});



// =================

// ================ Productions Routes ================== //



    // ------------------------ productions -------------------------------//

    Route::controller(ProductionController::class)->group(function(){
        Route::get('/tous/productions', 'AllProductions')->name('all.productions');
        Route::get('/filter/productions', 'FilterProduction')->name('filter.productions');
        Route::get('/ajouter/production', 'AddProduction')->name('add.production');
        Route::post('/store/production', 'StoreProduction')->name('store.production');
        Route::get('/modifier/production/{id}', 'EditProduction')->name('edit.production');
        Route::post('/update/production/{id}', 'UpdateProduction')->name('update.production');
        Route::get('/Afficher/production/{id}', 'ShowProduction')->name('show.production');
        Route::get('/delete/production/{id}', 'DeleteProduction')->name('delete.production');
        
        Route::get('/export-filtered-productions', 'ExportProductions')->name('export.filtered.productions');
        Route::get('/reset-production', 'ResetProductionFilter')->name('reset.production');


    });



   

// ------------------------ sinistres_at_rd -------------------------------//

Route::controller(SinistresAtRDController::class)->group(function(){
    Route::get('/tous/sinistres-at-rd', 'AllSinistres')->name('all.sinistres.at.rd');
    Route::get('/filter/sinistres-at-rd', 'FilterSinistre')->name('filter.sinistres.at.rd');
    Route::get('/ajouter/sinistre-at-rd', 'AddSinistre')->name('add.sinistre.at.rd');
    Route::post('/store/sinistre-at-d', 'StoreSinistre')->name('store.sinistre.at.rd');
    Route::get('/modifier/sinistre-at-rd/{id}', 'EditSinistre')->name('edit.sinistre.at.rd');
    Route::get('/Afficher/sinistre-at-rd/{id}', 'ShowSinistre')->name('show.sinistre.at.rd');
    Route::post('/update/sinistre-at-rd/{id}', 'UpdateSinistre')->name('update.sinistre.at.rd');
    Route::get('/delete/sinistre-at-rd/{id}', 'DeleteSinistre')->name('delete.sinistre.at.rd');
    
    Route::get('/export/filtered-sinistres-at-rd', 'ExportSinistres')->name('export.filtered.sinistres.at.rd');
    Route::get('/reset/sinistre-at-rd', 'ResetSinistreFilter')->name('reset.sinistres.at.rd');


});



  
// ------------------------ sinistres_dim -------------------------------//

Route::controller(SinistreDimController::class)->group(function(){
    Route::get('/tous/sinistres-dim', 'AllSinistreDim')->name('all.sinistres.dim');
    Route::get('/filter/sinistres-dim', 'FilterSinistreDim')->name('filter.sinistres.dim');
    Route::get('/ajouter/sinistre-dim', 'AddSinistreDim')->name('add.sinistre.dim');
    Route::post('/store/sinistre-dim', 'StoreSinistreDim')->name('store.sinistre.dim');
    Route::get('/modifier/sinistre-dim/{id}', 'EditSinistreDim')->name('edit.sinistre.dim');
    Route::get('/Afficher/sinistre-dim/{id}', 'ShowSinistreDim')->name('show.sinistre.dim');
    Route::post('/update/sinistre-dim/{id}', 'UpdateSinistreDim')->name('update.sinistre.dim');
    Route::get('/delete/sinistre-dim/{id}', 'DeleteSinistreDim')->name('delete.sinistre.dim');
    
    Route::get('/export-filtered-sinistres', 'ExportSinistreDim')->name('export.filtered.sinistres.dim');
    Route::get('/reset-sinistre-dim', 'ResetSinistreDimFilter')->name('reset.sinistres.dim');


});