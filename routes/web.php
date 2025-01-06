<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintsController;

use App\Http\Controllers\PublicComplaintController;

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
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


Route::prefix('public_complaints')->name('public_complaints.')->group(function () {
    Route::get('create', [PublicComplaintController::class, 'create'])->name('create'); // Paparan borang aduan
    Route::post('store', [PublicComplaintController::class, 'store'])->name('store'); // Simpan rekod aduan
    Route::get('index', [PublicComplaintController::class, 'index'])->name('index'); // Senarai aduan (Rute index)
    Route::get('status-check', [PublicComplaintController::class, 'statusCheckForm'])->name('statusCheckForm'); // Paparan borang semakan emel
    Route::post('status-check', [PublicComplaintController::class, 'checkStatus'])->name('checkStatus'); // Proses semakan berdasarkan emel
    Route::get('{complaint}/edit', [PublicComplaintController::class, 'edit'])->name('edit'); // Kemaskini aduan
    Route::put('{complaint}', [PublicComplaintController::class, 'update'])->name('update'); // Simpan kemaskini
    Route::delete('{complaint}', [PublicComplaintController::class, 'destroy'])->name('destroy'); // Padam aduan
    Route::get('{complaint}', [PublicComplaintController::class, 'show'])->name('show'); // Paparan butiran aduan
});// Route public_complaints


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // complaints
    Route::resource('complaints', ComplaintsController::class);
    Route::get('/storage/uploads/{filename}', function ($filename) {
        $path = storage_path('app/uploads/' . $filename);
    
        if (!file_exists($path)) {
            abort(404); // Jika fail tidak wujud
        }
    
        $mimeType = mime_content_type($path); // Tentukan jenis MIME gambar
        return response()->file($path, ['Content-Type' => $mimeType]);
    })->name('storage.uploads');
});

require __DIR__.'/auth.php';


