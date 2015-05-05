<?php namespace App\Services;

use Cache;
use SimpleXMLElement;

class GoodReads 
{

	public static function search($book_title)
	{

		 if(Cache::has("$book_title")) 
		 {
			$goodReadsData = Cache::get("$book_title");
		 } 
		 else 
		 {
			$url = "https://www.goodreads.com/search.xml?key=9QLSHxz1SyamS5ReGmuWew&q=" . urlencode($book_title);
			$goodReads = file_get_contents($url);
			$goodReadsData = new SimpleXMLElement($goodReads);
			Cache::put("$book_title", $goodReadsData->asXML(), 60);
			return $goodReadsData;
		 }
		
		$xml = simplexml_load_string($goodReadsData);
		return $xml;
		
	}
}
?>

