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
		return $this->getLocationFromQuery($query);
	}

	public function getLocationFromQuery($query)
	{
		$attributes = array(
			'sensor' => 'false',
			'address' => $query
		);

		$response = $this->curl->get($this->url, $attributes);

		$response = json_decode($response->body);

		return $this->location->newLocationFromObject($response->results[0]);
	}
}
