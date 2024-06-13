<?php

use App\Http\Controllers\DatasetController;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Production\LongTerm;
use App\Livewire\Production\Year;

use App\Livewire\ConsolidatedSurplusUw\SurplusUwLongTerm;
use App\Livewire\ConsolidatedSurplusUw\ProfitLossLongTerm;
use App\Livewire\ConsolidatedSurplusUw\SurplusUwYear;
use App\Livewire\ConsolidatedSurplusUw\ProfitLossYear;
use App\Livewire\Claim\AcceptedClaim;
use App\Livewire\Claim\RejectClaim;
use App\Livewire\Claim\OutstandingClaim;
use App\Livewire\SearchCif\SurplusUwLongTerm as SearchCifSurplusUwLongTerm;
use App\Livewire\SearchCif\SurplusUwYear as SearchCifSurplusUwYear;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function ()
{
    return redirect('dashboard');
});

Route::View('/stimulsoft', 'stimulsoft');

Route::get('/login', Login::class)->name('login');

Route::group(['middleware' => ['auth']], function ()
{

    Route::get('/dataset-production-long-term', [DatasetController::class, 'getDatasetProductionLongTerm'])->name('dataset.production-long-term');

    Route::get('/dataset-production-year', [DatasetController::class, 'getDatasetProductionYear'])->name('dataset.production-year');
    Route::get('/dataset-consolidated-surplus-uw-long-term', [DatasetController::class, 'getDatasetConsolidatedSurplusUwLongTerm'])->name('dataset.consolidated-surplus-uw-long-term');
    Route::get('/dataset-consolidated-surplus-uw-year', [DatasetController::class, 'getDatasetConsolidatedSurplusUwYear'])->name('dataset.consolidated-surplus-uw-year');
    Route::get('/dataset-consolidated-profit-loss-long-term', [DatasetController::class, 'getDatasetConsolidatedProfitLossLongTerm'])->name('dataset.consolidated-profit-loss-long-term');
    Route::get('/dataset-consolidated-profit-loss-year', [DatasetController::class, 'getDatasetConsolidatedProfitLossYear'])->name('dataset.consolidated-profit-loss-year');
    Route::get('/dataset-accepted-claim', [DatasetController::class, 'getDatasetAcceptedClaim'])->name('dataset.accepted-claim');
    Route::get('/dataset-reject-claim', [DatasetController::class, 'getDatasetRejectClaim'])->name('dataset.reject-claim');
    Route::get('/dataset-outstanding-claim', [DatasetController::class, 'getDatasetOutstandingClaim'])->name('dataset.outstanding-claim');


    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/production/Index', \App\Livewire\Production\Index::class)->name('production.index');
    Route::get('/production/long-term', LongTerm::class)->name('production.long-term');
    Route::get('/production/year', Year::class)->name('production.year');

    Route::get('/consolidated-surplus-uw/surplus-uw-long-term', SurplusUwLongTerm::class)->name('consolidated-surplus-uw.surplus-uw-long-term');
    Route::get('/consolidated-surplus-uw/surplus-uw-year', SurplusUwYear::class)->name('consolidated-surplus-uw.surplus-uw-year');

    Route::get('/consolidated-surplus-uw/profit-loss-year', ProfitLossYear::class)->name('consolidated-surplus-uw.profit-loss-year');

    Route::get('/consolidated-surplus-uw/profit-loss-long-term', ProfitLossLongTerm::class)->name('consolidated-surplus-uw.profit-loss-long-term');

    Route::get('/claim/accepted-claim', AcceptedClaim::class)->name('claim.accepted-claim');
    Route::get('/claim/reject-claim', RejectClaim::class)->name('claim.reject-claim');
    Route::get('/claim/outstanding-claim', OutstandingClaim::class)->name('claim.outstanding-claim');


    Route::get('/search-cif/surplus-uw-long-term', SearchCifSurplusUwLongTerm::class)->name('search-cif.surplus-uw-long-term');
    Route::get('/search-cif/surplus-uw-year', SearchCifSurplusUwYear::class)->name('search-cif.surplus-uw-year');


    Route::get('/logout', function ()
    {
        Auth::logout();
        return redirect('login');
    })->name('logout');
});
