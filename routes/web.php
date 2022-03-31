<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
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

Route::get('/',[FirstController::class,'getIndex']) ;
Route::post('denemeiki', [FirstController::class,'denemeiki']);
Route::get('anaekran', [FirstController::class, 'logın']);
Route::get('profilogrenci/{id}', [FirstController::class, 'profil']);
Route::get('anaekraniki/{id}', [FirstController::class, 'logıniki']);
Route::get('yonetıcıgırıs', [FirstController::class, 'yoneticilogin']);
Route::post('denemeüc', [FirstController::class,'denemeüc']);
Route::get('profilyonetici/{id}', [FirstController::class, 'profilyonetici']);
Route::get('anaekranüc/{id}', [FirstController::class, 'yoneticianaekran']);
Route::get('danısmanekle/{id}', [FirstController::class, 'danısmanekle']);
Route::get('ogrencianekle/{id}', [FirstController::class, 'ogrenciekle']);
Route::get('ogrenciekleiki/{id}/{idiki}', [FirstController::class, 'ogrenciekleiki']);
Route::post('danısmann/{id}', [FirstController::class,'danısmann']);
Route::get('onkayitgiris', [FirstController::class, 'onkayitgiris']);
Route::post('ekle', [FirstController::class,'ekle']);
Route::post('danısmangiris', [FirstController::class,'danısmangiris']);
Route::get('danısmangırıs', [FirstController::class, 'danısmangırıs']);
Route::get('guncelleyonetıcı/{id}', [FirstController::class, 'guncelleyonetıcı']);
Route::post('sistemgüncelle/{id}', [FirstController::class,'sistemgüncelle']);
Route::get('guncelleogrenci/{id}', [FirstController::class, 'guncelleogrenci']);
Route::post('ogrencigüncelle/{id}', [FirstController::class,'ogrencigüncelle']);
Route::get('profildanısman/{id}', [FirstController::class, 'profildanısman']);
Route::post('danısmangüncelle/{id}', [FirstController::class,'danısmangüncelle']);
Route::get('guncelledanısman/{id}', [FirstController::class, 'guncelledanısman']);
Route::get('raporekranı/{id}', [FirstController::class, 'raporekranı']);
Route::get('danısmanrapor/{id}', [FirstController::class, 'danısmanrapor']);
Route::post('/pdfyukle/{id}/{idiki}',[FirstController::class,'store']);
Route::get('/goster',[FirstController::class,'goster']);
Route::get('/download/{file}',[FirstController::class,'download']);
Route::get('/goruntule/{is}',[FirstController::class,'goruntule']);
Route::get('/goruntuleiki/{is}',[FirstController::class,'goruntuleiki']);
Route::get('donemproje/{id}', [FirstController::class, 'donemproje']);
Route::get('atamayap/{id}', [FirstController::class,'atamayap']);
Route::get('konuekranı/{id}',[FirstController::class,'konuekranı']);
Route::get('konubelirle/{id}', [FirstController::class,'konubelirle']);
Route::get('konuonay/{id}',[FirstController::class,'konuonay']);
Route::get('onayla/{id}/{idiki}', [FirstController::class, 'onayla']);
Route::get('düzenleiste/{id}/{idiki}', [FirstController::class, 'düzenleiste']);
Route::get('rediste/{id}/{idiki}', [FirstController::class, 'rediste']);
Route::post('düzen/{id}/{idiki}', [FirstController::class, 'düzen']);
Route::post('red/{id}/{idiki}', [FirstController::class, 'red']);
Route::get('konular/{id}',[FirstController::class,'konular']);
Route::get('düzenlenmeisteği/{id}/{idiki}',[FirstController::class,'düzenlenmeisteği']);
Route::get('konudüzenleiki/{id}/{idiki}', [FirstController::class,'konudüzenleiki']);
Route::get('raporeklemeiki/{id}/{idiki}', [FirstController::class,'raporeklemeiki']);
Route::get('raporonayla/{id}/{idiki}',[FirstController::class,'raporonayla']);
Route::post('redrapor/{id}/{idiki}', [FirstController::class, 'redrapor']);
Route::get('oncekiraporlar/{id}/{idiki}', [FirstController::class,'oncekiraporlar']);
Route::get('onaylaiki/{id}/{idiki}', [FirstController::class,'onaylaiki']);
Route::get('raporeklemeüc/{id}/{idiki}', [FirstController::class,'raporeklemeüc']);
Route::post('/pdfyukleiki/{id}/{idiki}',[FirstController::class,'storeiki']);
Route::get('danısmanoncekiraporlar/{id}/{idiki}',[FirstController::class,'danısmanoncekiraporlar']);
Route::get('tezekranı/{id}', [FirstController::class, 'tezekranı']);
Route::get('tezyükleme/{id}/{idiki}', [FirstController::class,'tezyükleme']);
Route::post('/pdfyukleüc/{id}/{idiki}',[FirstController::class,'storeüc']);
Route::get('danısmantez/{id}', [FirstController::class, 'danısmantez']);
Route::get('onaylaüc/{id}/{idiki}', [FirstController::class,'onaylaüc']);
Route::get('tezonayla/{id}/{idiki}',[FirstController::class,'tezonayla']);
Route::post('redtez/{id}/{idiki}', [FirstController::class, 'redtez']);
Route::get('oncekitezler/{id}/{idiki}', [FirstController::class,'oncekitezler']);
Route::get('tezeklemeüc/{id}/{idiki}', [FirstController::class,'tezeklemeüc']);
Route::post('/pdfyukledört/{id}/{idiki}',[FirstController::class,'storedört']);
Route::get('danısmanoncekitezler/{id}/{idiki}',[FirstController::class,'danısmanoncekitezler']);
Route::get('danısmantumogrenciler/{id}', [FirstController::class, 'danısmantumogrenciler']);
Route::get('ogrenciprofildört/{id}/{idiki}', [FirstController::class, 'ogrenciprofildört']);
Route::get('cıkısyap', [FirstController::class,'cıkısyap']);
Route::get('danısmangoruntule/{id}', [FirstController::class, 'danısmangoruntule']);
Route::get('yonetıcısdanısmanlar/{id}', [FirstController::class, 'yonetıcısdanısmanlar']);
Route::get('yonetıcısogrenciler/{id}', [FirstController::class, 'yonetıcısogrenciler']);
Route::get('yonetıcısyonetıcıs/{id}', [FirstController::class, 'yonetıcısyonetıcıs']);
Route::get('projeilerlemesiüc/{id}', [FirstController::class, 'projeilerlemesiüc']);
Route::get('danısmananasayfa/{id}', [FirstController::class, 'danısmananasayfa']);
