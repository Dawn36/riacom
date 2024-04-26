<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDocumentController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientNoteController;
use App\Http\Controllers\ClientFileController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractFileController;
use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('event', EventController::class);
    Route::resource('contract-file', ContractFileController::class);
    Route::resource('contract', ContractController::class);
    Route::get('get-provider-user', [ContractController::class, 'providerUser'])->name('get-provider-user');
    Route::get('check-vat-number-client', [ContractController::class, 'checkVatNumberClient'])->name('check-vat-number-client');
    
    Route::resource('client-note', ClientNoteController::class);
    Route::resource('client-file', ClientFileController::class);
    Route::resource('client', ClientController::class);
    Route::get('clinet_counter', [ClientController::class, 'clientCounter'])->name('clinet_counter');
    Route::post('client_status_update', [ClientController::class, 'clientStatusUpdate'])->name('client_status_update');

    Route::resource('lead', LeadController::class);
    Route::resource('product-doc', ProductDocumentController::class);
    Route::resource('product', ProductController::class);
    Route::resource('provider', ProviderController::class);
    Route::resource('user', UserController::class);
    Route::get('admin', [UserController::class, 'admin'])->name('admin');
    
    Route::resource('settings', SettingsController::class);
    Route::post('/settings/{id}/updateEmail', [SettingsController::class, 'updateEmail'])->name('updateEmail');
    Route::post('/settings/{id}/updatePassword', [SettingsController::class, 'updatePassword'])->name('updatePassword');
});

require __DIR__.'/auth.php';
