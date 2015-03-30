<?php namespace App\Services;

use Cache;

class RottenTomatoes 
{

	public static function search($dvd_title)
	{

		if(Cache::has("rottenDetails-$dvd_title")) 
		{
			$rottenJSON = Cache::get("rottenDetails-$dvd_title");
		} 
		else 
		{
			$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=49r28w4kzas2hmf587mff98u&q=" . urlencode($dvd_title);
			$rottenJSON = file_get_contents($url);
			Cache::put("rottenDetails-$dvd_title", $rottenJSON, 60);
		}
		
		return json_decode($rottenJSON)->movies;
		
	}
}
?>