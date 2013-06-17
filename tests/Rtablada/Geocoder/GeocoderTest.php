<?php namespace Rtablada\Geocoder;

use Mockery as m;

class GeocoderTest extends \PHPUnit_Framework_Testcase
{
	protected $query = "Atlanta";

	public function teardown()
	{
		m::close();
	}

	public function setup()
	{
		$this->coordinateResult = new Coordinate(33.748995, -84.387982);
		$this->locationResult = new Location('Atlanta, GA, USA', $this->coordinateResult);

		$this->curl = m::mock('Curl');
		$this->location = m::mock('Rtablada\Geocoder\Location');

		$this->response = new \StdClass;
		$this->response->body = file_get_contents(__DIR__ . '/json/atlanta.json');

		$this->curl->shouldReceive('get')
			->with('http://maps.googleapis.com/maps/api/geocode/json', m::type('Array'))
			->once()
			->andReturn($this->response);

		$this->geocoder = new Geocoder($this->curl, $this->location);
	}

	public function testGetCoordinatesFromQuery()
	{
		$result = $this->geocoder->getCoordinatesFromQuery($this->query);

		// $this->assertEquals($this->coordinateResult, $result);
	}

	public function testGetLocationFromQuery()
	{
		$result = $this->geocoder->getLocationFromQuery($this->query);

		$this->assertEquals($this->locationResult, $result);
	}
}
