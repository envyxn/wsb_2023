<?php

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('wsb', function(){
    return view( 'wsb', ['firstName' => 'Franek', 'lastName' => 'Nowak']);
});


Route::get('pages/{page}', function (string $page){
  $pages = [
    'about' => 'Informacje o stronie',
    'contact' => 'franek@gmail.com',
    'home' => 'Strona domowa'
  ];

    return $pages[$page]??"Błędne dane wprowadzone przez użytkownika!";
})->name('pages');

Route::get('/address/{city?}/{street?}/{postalCode?}', function(string $city = '-', string $street = '-', int $postalCode = null){
    /*
    if (is_null($postalCode))
     $postalCode = 'brak kodu pocztowego';
    else
     $postalCode = substr($postalCode, offset:0, length:2).'-'.substr($postalCode, offset:2, length:3);
    */
    //potrójny operator porównania
    $postalCode = is_null($postalCode) ? 'brak kodu pocztowego' : substr($postalCode, offset:0, length:2).'-'.substr($postalCode, offset:2, length:3);
    echo <<< SHOW
     Kod pocztowy: $postalCode<br>
     Miasto: $city<br>
     Ulica: $street<br>

SHOW;
})->name('adres');


Route::redirect('adres/{city?}/{street?}/{postalCode?}', '/address/{city?}/{street?}/{postalCode?}');
