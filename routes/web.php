<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidatsController;
use App\Http\Controllers\ConvocationController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ResultatsController;
use App\Http\Controllers\SallesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\FichePresenceController;
use App\Http\Controllers\DataImportController;

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
Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login', [LoginController::class, 'check'])->name('login.check');
Route::get('/home', function(){
  return redirect()->route('dashboard');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('dashboard')->middleware('auth')->group( function(){
    Route::get('/', function(){
        return view('dashboard');
    })->name('dashboard');
    Route::resource('candidats', CandidatsController::class);

    Route::get('convocation/{candidat}', [ConvocationController::class, 'index'])->name('candidats.convocation');

    Route::get('candidats/ecole/{ecole}', [CandidatsController::class, 'ecole'])->name('candidats.ecole');
    Route::get('candidats/ecole/{ecole}/parcours/{parcour}', [CandidatsController::class, 'parcours'])->name('candidats.parcours');

    Route::get('candidats/operation/attribution', [CandidatsController::class, 'attribution'])->name('candidats.attribution');
    Route::get('candidats/fiche/presence', [FichePresenceController::class, 'index'])->name('fiche.centres');
    Route::get('candidats/fiche/presence/{centre}/{salle?}', [FichePresenceController::class, 'centre'])->name('fiche.centre');
    Route::get('candidats/operation/attribution/numero', [AttributionController::class, 'attribuer_numero_cadidat'])->name('candidats.attribution.numero');
    Route::get('candidats/operation/attribution/salle', [AttributionController::class, 'attribuer_salle_candidat'])->name('candidats.attribution.salle');

    Route::get('notes/saisit/{parcour}', [NotesController::class, 'transcription'])->name('notes.transcription');
    Route::post('notes/saisit', [NotesController::class, 'update'])->name('notes.update');

    Route::resource('users', UsersController::class);
    Route::get('/users/profile', [ UsersController::class, 'profile' ])->name('users.profile');

    Route::get('/resultats/brute/{parcour?}', [ResultatsController::class, 'brute'])->name('resultats.brute');
    Route::get('/resultats/deliberation/{parcour?}', [ResultatsController::class, 'deliberation'])->name('resultats.deliberation');
    Route::resource('salles', SallesController::class);
    Route::get('/salle/liste', [ SallesController::class, 'liste'])->name('salles.list');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/appinfo', [SettingsController::class, 'appInfo'])->name('settings.appinfo');
    Route::put('/settings/concours', [SettingsController::class, 'concours'])->name('settings.concours');
    Route::resource('concours', ConcoursController::class);

    Route::get('/parcours', [ParcoursController::class, 'index'])->name('parcours.index');
    Route::post('/parcours', [ParcoursController::class, 'store'])->name('parcours.store');
    Route::post('/parcours/update', [ParcoursController::class, 'update'])->name('parcours.update');
    Route::post('/parcours/delete', [ParcoursController::class, 'destroy'])->name('parcours.delete');

    Route::get('/data-import', [ DataImportController::class, 'index'] );
});
Route::get('/', function(){
  return redirect()->to('/dashboard');
});