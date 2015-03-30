<?php

use App\Models\DvdE;
use App\Models\Dvd;
use App\Models\Dvd2;
use App\Models\Rating;
use App\Models\Sound;
use App\Models\Label;
use App\Models\Genre;
use App\Models\Format;
use App\Services\RottenTomatoes;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/dvds/search', 'DvdController@search');

Route::get('/dvds', 'DvdController@results');

Route::post('/dvds', 'DvdController@insertReview');

Route::get('/dvds/create', 'DvdController@create');

//Route::get('/dvds/{id}', 'DvdController@review');

Route::get('/dvds/{id}', function($id){
	$dvd = (new Dvd2())->getDvdWithId($id);
	$reviews = (new Dvd2())->findReviews($id);
	$foundRotten = 0;

	if (!empty($dvd))
	{
		$rottenArray = RottenTomatoes::search($dvd->title);

		if (!empty($rottenArray))
		{

			$rottenDetails = array_values($rottenArray)[0]->title;

			foreach ($rottenArray as $rottenMovie)
			{
				if ($rottenMovie->title == $dvd->title)
				{
					$rottenDetails = $rottenMovie;
					$foundRotten = 1;
				}
			}

			return view('review', [
					'id' => $id,
					'dvd' => $dvd,
					'reviews' => $reviews,
					'rottenDetails' => $rottenDetails,
					'foundRotten' => $foundRotten
				]);

		}

		return view('review', [
				'id' => $id,
				'dvd' => $dvd,
				'reviews' => $reviews,
				'foundRotten' => $foundRotten
			]);


	}

});

Route::post('/dvds', 'DvdController@insertDvd');

Route::get('/genres/{genre_name}/dvds', function($name){

	$genre = Genre::where('genre_name', '=', $name)->first()->pluck('id');
	
	$dvds = Dvd::with('genre', 'rating', 'label')->where('genre_id', '=', $genre)->get();

	return view('genre',[
		'dvds' => $dvds,
		'genre_name' => $name
	]);

});





Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
