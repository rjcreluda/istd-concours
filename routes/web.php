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
use App\Http\Controllers\ImpressionController;
use App\Http\Controllers\CandidatSaisitController;
use App\Http\Controllers\JuryController;
use App\Http\Controllers\AfficheListeCandidatsController;

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

    Route::get('print/preview', [ImpressionController::class, 'print'])->name('print.preview');

    //Route::get('convocation/{candidat}', [ConvocationController::class, 'index'])->name('candidats.convocation');

    // Impression convocation
    Route::get('convocation/parcours', [ConvocationController::class, 'liste_parcours'])->name('convocation.liste_parcours');
    Route::get('convocation/parcours/{parcour}/preview', [ConvocationController::class, 'preview'])->name('convocation.preview');
    Route::get('convocation/par_date', [ConvocationController::class, 'impression_par_date'])->name('convocation.par_date');
    Route::get('convocation/par_jour', [ConvocationController::class, 'impression_par_jour'])->name('convocation.par_jour');

    // Gestion candidats
    Route::get('candidats/ecole/{ecole}', [CandidatsController::class, 'ecole'])->name('candidats.ecole');
    Route::get('candidats/ecole/{ecole}/parcours/{parcour}', [CandidatsController::class, 'parcours'])->name('candidats.parcours');

    Route::get('candidats/operation/attribution', [CandidatsController::class, 'attribution'])->name('candidats.attribution');

    // Fiche de presence, selection centre examen
    Route::get('fiche-presence/centre-exam/{cycle}', [FichePresenceController::class, 'centre_examen'])->name('fiche.centre_exam');
    Route::get('candidats/fiche/presence', [FichePresenceController::class, 'index'])->name('fiche.centres');
    Route::get('fiche-presence/voir/{centre}/{salle?}', [FichePresenceController::class, 'voir'])->name('fiche.centre');
    Route::get('fiche-presence/voir-jury/{centre}/{jury?}', [FichePresenceController::class, 'voir_jury'])->name('fiche.jury');

    // Liste candidats pur affiche
    Route::get('liste-candidats/centre-exam', [AfficheListeCandidatsController::class, 'centre_examen'])->name('liste_candidat.centre_exam');
    Route::get('liste-candidats/fiche/presence', [AfficheListeCandidatsController::class, 'index'])->name('liste_candidat.centres');
    Route::get('liste-candidats/voir/{centre}/{parcours?}', [AfficheListeCandidatsController::class, 'voir'])->name('liste_candidat.centre');

    // Attribution salle numero et jury
    Route::get('candidats/operation/attribution/numero', [AttributionController::class, 'attribuer_numero_cadidat'])->name('candidats.attribution.numero');
    Route::get('candidats/operation/attribution/salle', [AttributionController::class, 'attribuer_salle_candidat'])->name('candidats.attribution.salle');
    Route::get('candidats/operation/attribution/jury', [AttributionController::class, 'attribuer_jury_candidat'])->name('candidats.attribution.jury');


    Route::get('candidats/saisit/jour', [CandidatSaisitController::class, 'saisit_du_jour'])->name('candidats.saisit-du-jour');

    // Gestion des notes
    Route::get('notes/saisit/{parcour}', [NotesController::class, 'transcription'])->name('notes.transcription');
    Route::post('notes/saisit', [NotesController::class, 'update'])->name('notes.update');

    // Gestion utilisateurs
    Route::resource('users', UsersController::class);
    Route::get('/users/profile', [ UsersController::class, 'profile' ])->name('users.profile');

    // Resultats concours
    Route::get('/resultats/brute/{parcour?}', [ResultatsController::class, 'brute'])->name('resultats.brute');
    Route::get('/resultats/deliberation/{parcour?}', [ResultatsController::class, 'deliberation'])->name('resultats.deliberation');
    //Route::get('/resultats/final/{parcour?}', [ResultatsController::class, 'deliberation'])->name('resultats.deliberation');

    Route::resource('salles', SallesController::class);
    Route::get('/salle/liste', [ SallesController::class, 'liste'])->name('salles.list');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/appinfo', [SettingsController::class, 'appInfo'])->name('settings.appinfo');
    Route::put('/settings/concours', [SettingsController::class, 'concours'])->name('settings.concours');
    Route::resource('concours', ConcoursController::class);

    // Parcours
    Route::get('/parcours', [ParcoursController::class, 'index'])->name('parcours.index');
    Route::post('/parcours', [ParcoursController::class, 'store'])->name('parcours.store');
    Route::post('/parcours/update', [ParcoursController::class, 'update'])->name('parcours.update');
    Route::post('/parcours/delete', [ParcoursController::class, 'destroy'])->name('parcours.delete');

    // Jury
    Route::get('/jury', [JuryController::class, 'index'])->name('jury.index');
    Route::get('/jury/{jury}', [JuryController::class, 'show'])->name('jury.show');
    Route::get('/jury/edit/{jury}', [JuryController::class, 'edit'])->name('jury.edit');
    Route::post('/jury', [JuryController::class, 'store'])->name('jury.store');
    Route::put('/jury/update/{jury}', [JuryController::class, 'update'])->name('jury.update');
    Route::delete('/jury/delete/{jury}', [JuryController::class, 'destroy'])->name('jury.delete');


    Route::get('/data-import', [ DataImportController::class, 'index'] );
});
Route::get('/', function(){
  return redirect()->to('/dashboard');
});