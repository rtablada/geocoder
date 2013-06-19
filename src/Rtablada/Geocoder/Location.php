<?php namespace Rtablada\Geocoder;

class Location
{
	/**
	 * Coordinates
	 * @var Rtablada\Geocoder\Coordinate
	 */
	public $coordinates;

	/**
	 * Address
	 * @var string
	 */
	public $address;

	public function __construct($address = null, Coordinate $coordinates = null)
	{
		$this->address = $address;
		$this->coordinates = $coordinates ?: new Coordinate;
	}

	public function setCoordinates($lat, $lng)
	{
		$this->coordinates->lat = $lat;
		$this->coordinates->lng = $lng;
	}

	public function newInstanceFromObject($obj)
	{
		$coordinates = $obj->geometry->location;
		$coordinates = $this->coordinates->newInstance($coordinates->lat, $coordinates->lng);
		return new static($obj->formatted_address, $coordinates);
	}

	public function newInstace($attributes = null)
	{
		if (!$attributes) {
			return new static;
		}

		if (isset($attributes['lat']) && isset($attributes['lng'])) {
			$coordinates = $this->coordinates->newInstace($attributes['lat'], $attributes['lng']);
		} else {
			$coordinates = $this->coordinates->newInstace();
		}

		if (isset($attributes['address'])) {
			return new static($attributes['address'], $coordinates);
		}

		return new static(null, $coordinates);
	}
}
