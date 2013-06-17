<?php namespace Rtablada\Geocoder;

use Mockery as m;

class LocationTest extends \PHPUnit_Framework_Testcase
{
	public function teardown()
	{
		m::close();
	}

	public function setup()
	{
		$this->coordinateResult = new Coordinate(33.74899540, -84.38798240);
		$this->locationResult = new Location('Atlanta, GA, USA', $this->coordinateResult);

		$this->obj = json_decode(file_get_contents(__DIR__ . '/json/atlanta.json'))->results[0];

		$this->location = new Location();
	}

	public function testNewInstanceFromObject()
	{
		$result = $this->location->newInstanceFromObject($this->obj);

		$this->assertEquals($this->locationResult, $result);
	}
}
