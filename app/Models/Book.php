<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Validator;

class Book extends Model {

	public function getGenres() {
	    $query = DB::table('genres')->orderBy('genre_name', 'asc');
	    return $query->get();
	}

	public static function getBooks() {
	    $query = DB::table('books')
	        ->select('*', 'books.id as book_id');

	    return $query;
	}

	public static function findReviews($id){
	    $query = DB::table('reviews')
	    ->select('title', 'description', 'rating')
	    ->where('book_id', $id);

	    return $query->get();
	}

	public function search($title, $author) {
	    $query = DB::table('books')
	        ->select('*', 'books.id as book_id');

	    if($title) {
	        $query->where('title', 'LIKE', '%' . $title . '%');
	    }

	    if($author) {
	        $query->where('author', 'LIKE', '%' . $author . '%');
	    }

	    // if($genre && $genre != 'all') {
	    //     $query->where('genre_id', '=', $genre);
	    // }


	    $query->orderBy('author', 'asc');

	    return $query->get();
	}

	public function getAll() {
    	return $this->search(null, null);
    }

    public static function getBookWithId($id) {
        $query = self::getBooks()
            ->where('books.id', '=', $id);

        return $query->first();
    }

    public static function insertReview($data) {
        DB::table('reviews')->insert($data);
    }

    public static function validate($input) {
        return Validator::make($input, [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
            'rating' => 'required|integer|max:5|min:1',
            'book_id' => 'required|integer'
        ]);
    }

}
