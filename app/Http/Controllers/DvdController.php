<?php

namespace App\Http\Controllers;

use App\Models\Dvd;
use App\Models\Dvd2;
use App\Models\Rating;
use App\Models\Sound;
use App\Models\Label;
use App\Models\Genre;
use App\Models\Format;

use Illuminate\Http\Request;


class DvdController extends Controller
{
	public function search()
	{

		$genres = (new Dvd2())->getGenres();
		$ratings = (new Dvd2())->getRatings();

		return view('search', [
			'genres' => $genres, 
			'ratings' => $ratings
			]);
	}

	public function results(Request $request)
	{
		$query = new Dvd2();


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

	public function review($id)
	{
		$dvd = Dvd2::getDvdWithId($id);
		$reviews = Dvd2::findReviews($id);

		$data = [ "dvd"     => $dvd,
				  "reviews" => $reviews ];

		return view('review', $data);
	}

	public function insertReview(Request $request)
	{
		$validation = Dvd2::validate($request->all());

		if ($validation->passes()) {
			Dvd2::insertReview([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'dvd_id' => $request->input('dvd_id'),
				'rating' => $request->input('rating')
				]);

			return redirect()->back()->with('success', 'Your review successfully added.');

		}

		return redirect()->back()->withErrors($validation);
	}

	public function create(){

		$sounds = Sound::all();
		$labels = Label::all();
		$genres = Genre::all();
		$ratings = Rating::all();
		$formats = Format::all();


		return view('create', [
			'labels' => $labels,
			'sounds' => $sounds,
			'genres' => $genres,
			'ratings' => $ratings,
			'formats' => $formats
		]);
	}

	public function insertDvd(Request $request) {

		$validation = \Validator::make($request->all(), [
				'title' => 'required',
				'genre' => 'required'
		]);

		if ($validation->passes()) {

			$dvd = new Dvd();

			$dvd->title = $request->input('title');
			$dvd->label_id = $request->input('label');
			$dvd->sound_id = $request->input('sound');
			$dvd->genre_id = $request->input('genre');
			$dvd->rating_id = $request->input('rating');
			$dvd->format_id = $request->input('format');
			$dvd->save();

			return redirect('/dvds/create')->with('success', 'Your dvd was successfully created!');

		}

		else {
			return redirect('/dvds/create')->withInput()->withErrors($validation);
		}


	}


}