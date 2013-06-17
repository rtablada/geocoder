<?php namespace Rtablada\Geocoder;

use Curl;

class Geocoder
{
	protected $url;

	protected $curl;
	protected $location;
	protected $coordinate;

	public function __construct(Curl $curl = null, Location $location = null, $url = 'http://maps.googleapis.com/maps/api/geocode/json')
	{
		$this->curl = $curl ?: new Curl;
		$this->location = $location ?: new Location;
		$this->url = $url;
	}

	public function getCoordinatesFromQuery($query)
	{
		return $this->getLocationFromQuery($query)->coordinates;
	}

	public function getLocationFromQuery($query)
	{
		$attributes = array(
			'sensor' => 'false',
			'address' => $query
		);

		$response = $this->curl->get($this->url, $attributes);

		$response = json_decode($response->body);

		return $this->location->newInstanceFromObject($response->results[0]);
	}

	public function getSearchSquare(Coordinate $center, $radius)
	{
		$searchSquare = array();
		$searchSquare['lat'][] = $center->lat - $radius / 69.01;
		$searchSquare['lat'][] = $center->lat + $radius / 69.01;

		$searchSquare['lng'][] = $center->lng - ($radius / ( 69.172 * cos($center->lat * 0.0174533)));
		$searchSquare['lng'][] = $center->lng + ($radius / ( 69.172 * cos($center->lat * 0.0174533)));

		return $searchSquare;
	}
}
