<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\User;

use Illuminate\Http\Request;

class BookController extends Controller
{
	public function search()
	{
		$genres = (new Book())->getGenres();


		return view('booksearch', [
			'genres' => $genres
			]);
	}

	public function results(Request $request)
	{
		$query = new Book();


		if (empty($request->all()))
		{
			$books = $query->getAll();
			$title = "";
			$author = "";
			$genre = "";
		}
		else {
			$title = $request->input('title');
			$author = $request->input('author');
			$genre = $request->input('genre');
			$books = $query->search($title, $author);
		}

		return view('bookresults', 
			[		
			'title' => $title,
			'author' => $author,
			'genre' => $genre,
			'books'  => $books
			]);
	}

	public function insertReview(Request $request)
	{
		$validation = Book::validate($request->all());

		if ($validation->passes()) {
			Book::insertReview([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'book_id' => $request->input('book_id'),
				'rating' => $request->input('rating')
				]);

			return redirect()->back()->with('success', 'Your review successfully added.');

		}

		return redirect()->back()->withErrors($validation);
	}

	public function create()
	{
		$genres = (new Book())->getGenres();


		return view('bookcreate', [
			'genres' => $genres
			]);
	}

	public function insertBook(Request $request) {

		$validation = \Validator::make($request->all(), [
				'title' => 'required',
				'author' => 'required',
				'publication_date' => 'required|integer|min:1000|max:2016'
		]);

		if ($validation->passes()) {

			$book = new Book();

			$book->title = $request->input('title');
			$book->author = $request->input('author');
			$book->genre_id = $request->input('genre');
			$book->publication_date = $request->input('publication_date');
			$book->save();

			return redirect('/books/create')->with('success', 'Your book was successfully created!');

		}

		else {
			return redirect('/books/create')->withInput()->withErrors($validation);
		}


	}


}