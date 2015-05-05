<?php


use App\Models\Book;
use App\User;
use App\Services\GoodReads;

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

Route::get('/signup', function(){
	return view('signup');
});

Route::post('/signup', function()
{
  $validation = User::validate(Request::all());

  if ($validation->passes()) {
    $user = new User();
    $user->name = Request::input('name');
    $user->email = Request::input('email');
    $user->password = Hash::make(Request::input('password'));
    $user->save();

    Auth::loginUsingId($user->id);
    return redirect('dashboard');
  }

  return redirect('signup')->withErrors($validation->errors());
});

Route::get('/login', function() {
	if (Auth::check())
		return redirect('dashboard');
	return view('login');
});

Route::post('/login', function()
{

  $validation = User::validate(Request::all());		

  $credentials = [
  	'name' => Request::input('name'),
    'email' => Request::input('email'),
    'password' => Request::input('password')
  ];

  $remember_me = Request::input('remember_me') == 'on' ? true : false;

  if (Auth::attempt($credentials, $remember_me)) {
    return redirect('dashboard');
  }

  return redirect('login')
      ->with('flash_error', 'Your username/password combination was incorrect.')
      ->withInput();
});

Route::group(['middleware' => 'auth'], function(){

	Route::get('/dashboard', function() {
		return view('dashboard');
	});

	Route::get('/books', 'BookController@results');

	Route::post('/books', 'BookController@insertReview');

	Route::get('books/create', 'BookController@create');

	Route::post('/books/create', 'BookController@insertBook');

	Route::get('/books/search', 'BookController@search');

	Route::get('/books/{id}', function($id){
		$book = (new Book())->getBookWithId($id);
		$reviews = (new Book())->findReviews($id);
		$foundGood = 0;

		if (!empty($book))
		{
			$grXML = GoodReads::search($book->title);
			//dd($grXML);
			$book_author = $grXML->search->results->work[0]->best_book->author->name;
			$book_title = $grXML->search->results->work[0]->best_book->title;
			$book_img = $grXML->search->results->work[0]->best_book->image_url;
			$book_year = $grXML->search->results->work[0]->original_publication_year;
			$book_avg_rating = $grXML->search->results->work[0]->average_rating;

			if (!empty($book_title))
			{


				$foundGood = 1;

				return view('bookreview', [
						'id' => $id,
						'book' => $book,
						'reviews' => $reviews,
						'book_img' => $book_img,
						'book_author' => $book_author,
						'book_year' => $book_year,
						'book_avg_rating' => $book_avg_rating,
						'foundGood' => $foundGood
					]);

			}

			return view('bookreview', [
					'id' => $id,
					'book' => $book,
					'reviews' => $reviews,
					'foundGood' => $foundGood
				]);


		}

	});

});

Route::get('/logout', function()
{

  Auth::logout();
  return redirect('/')->with('success', 'You have succesfully logged out.');

});

Route::get('/about', function(){
	return view('about');
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
