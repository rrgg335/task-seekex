<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BallsController,BucketsController,PlacementController,SuggestionsController};

Route::middleware('guest:web')->group(function(){
	Route::redirect('/','current-placement');
	Route::prefix('balls')->controller(BallsController::class)->name('balls.')->group(function(){
		Route::get('/','index')->name('index');
		Route::post('create','create')->name('create');
		Route::get('delete/{id}','delete')->name('delete');
	});
	Route::prefix('buckets')->controller(BucketsController::class)->name('buckets.')->group(function(){
		Route::get('/','index')->name('index');
		Route::post('create','create')->name('create');
		Route::get('delete/{id}','delete')->name('delete');
	});
	Route::prefix('bucket-suggestion')->controller(SuggestionsController::class)->name('bucket-suggestion.')->group(function(){
		Route::get('/','index')->name('index');
		Route::post('create','create')->name('create');
	});
	Route::prefix('current-placement')->controller(PlacementController::class)->name('current-placement.')->group(function(){
		Route::get('/','index')->name('index');
		Route::get('clear-all','clearAll')->name('clear-all');
	});
});