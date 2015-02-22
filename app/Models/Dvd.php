<?php
namespace App\Models;

use DB;

class Dvd {

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

    public function getAll() {
    	return $this->search(null, null, null);
    }

}