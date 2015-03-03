<?php
namespace App\Models;

use DB;
use Validator;

class Dvd2 {

	public function getGenres() {
	    $query = DB::table('genres')->orderBy('genre_name', 'asc');
	    return $query->get();
	}
	public function getRatings() {
	    $query = DB::table('ratings')->orderBy('rating_name','asc');
	    return $query->get();
	}

    public function search($title, $rating, $genre) {
        $query = DB::table('dvds')
            ->select('*', 'dvds.id as dvd_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        if($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }

        if($rating && $rating != 'all') {
            $query->where('rating_id', '=', $rating);
        }

        if($genre && $genre != 'all') {
            $query->where('genre_id', '=', $genre);
        }

        $query->orderBy('title', 'asc');

        return $query->get();
    }

    public static function getDvds() {
        $query = DB::table('dvds')
            ->select('*', 'dvds.id as dvd_id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');

        return $query;
    }

    public function getAll() {
    	return $this->search(null, null, null);
    }

    public static function findReviews($id){
        $query = DB::table('reviews')
        ->select('title', 'description', 'rating')
        ->where('dvd_id', $id);

        return $query->get();
    }

    public static function getDvdWithId($id) {
        $query = self::getDvds()
            ->where('dvds.id', '=', $id);

        return $query->first();
    }

    public static function insertReview($data) {
        DB::table('reviews')->insert($data);
    }

    public static function validate($input) {
        return Validator::make($input, [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
            'rating' => 'required|integer|max:10|min:1',
            'dvd_id' => 'required|integer'
        ]);
    }


}