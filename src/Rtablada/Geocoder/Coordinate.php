<?php namespace Rtablada\Geocoder;

class Coordinate
{
	/**
	 * Latitude
	 * @var float
	 */
	public $lat;

	/**
	 * Longitude
	 * @var float
	 */
	public $lng;

	public function __construct($lat, $lng)
	{
		$this->lat = $lat;
		$this->lng = $lng;
	}
}
