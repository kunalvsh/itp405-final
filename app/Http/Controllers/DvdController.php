<?php

namespace App\Http\Controllers;

use App\Models\Dvd;
use Illuminate\Http\Request;


class DvdController extends Controller
{
	public function search()
	{

		$genres = (new Dvd())->getGenres();
		$ratings = (new Dvd())->getRatings();

		return view('search', [
			'genres' => $genres, 
			'ratings' => $ratings
			]);
	}
	public function results(Request $request)
	{
		$query = new Dvd();


		if (empty($request->all()))
		{
			$dvds = $query->getAll();
			$title = "None";
			$rating = "";
			$genre = "";
		}
		else {
			$title = $request->input('title');
			$genre = $request->input('genre');
			$rating = $request->input('rating');
			$dvds = $query->search($title, $rating, $genre);
		}

		return view('results', ['title' => $title,
					'rating' => $rating,
					'genre' => $genre,
					'dvds'  => $dvds
			    	]);
	}
}