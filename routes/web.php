<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcome;
use App\Http\Controllers\FormController;

/*ImageController
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [welcome::class, 'welcome'])->name('welcome');

Route::get('/form/{block}/{tipo_documento}/{numero_documento}', [FormController::class, 'show'])
    ->name('form.show');
Route::post('/form/store', [FormController::class, 'store'])
    ->name('form.store');