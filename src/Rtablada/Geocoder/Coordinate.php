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

	public function __construct($lat = 0, $lng = 0)
	{
		$this->lat = $lat;
		$this->lng = $lng;
	}

	public function newInstance($lat = null, $lng = null)
	{
		return new static($lat, $lng);
	}
}
