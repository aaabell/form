<?php

use App\Models\FormTemplate;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $formTemplates = FormTemplate::all();
    return view('welcome', [
        'formTemplates' => $formTemplates
    ]);
})->name('form.public');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/form/{id}', 'FormController@viewForm')->name('form.view');


Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/list-from', 'FormController@listFrom')->name('form.list');
    Route::any('/add-form', 'FormController@addUpdateForm')->name('form.add');
    Route::any('/edit-form/{id}', 'FormController@editForm')->name('form.edit');
    Route::post('/delete-form-input', 'FormController@deleteFormInput')->name('form.delete');
});

