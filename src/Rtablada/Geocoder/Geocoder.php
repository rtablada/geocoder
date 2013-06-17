<?php namespace Rtablada\Geocoder;

use Curl;

class Geocoder
{
	protected $url;

	protected $curl;
	protected $location;
	protected $coordinate;

	public function __construct(Curl $curl, Location $location, $url = 'http://maps.googleapis.com/maps/api/geocode/json')
	{
		$this->curl = $curl;
		$this->location = $location;
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

	public function getSearchSquare(Coordinate $coordinates, $radius)
	{
		$searchSquare = array();
		$searchSquare['lat'][] = $coordinates->lat - $radius / 69.01;
		$searchSquare['lat'][] = $coordinates->lat + $radius / 69.01;

		$searchSquare['lng'][] = $coordinates->lng - ($radius / ( 69.172 * cos($coordinates->lat * 0.0174533)));
		$searchSquare['lng'][] = $coordinates->lng + ($radius / ( 69.172 * cos($coordinates->lat * 0.0174533)));

		return $searchSquare;
	}
}
