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
		$this->coordinateResult = new Coordinate(33.74899540, -84.38798240);
		$this->coordinateSquareResult = array(
			'lat' => array(
				33.6765421323576,
				33.8214486676424
			),
			'lng' => array(
				-84.4749161222352,
				-84.3010486777648
			)
		);
		$this->locationResult = new Location('Atlanta, GA, USA', $this->coordinateResult);

		$this->curl = m::mock('Curl');
		$this->location = m::mock('Rtablada\Geocoder\Location');

		$this->response = new \StdClass;
		$this->response->body = file_get_contents(__DIR__ . '/json/atlanta.json');

		$this->geocoder = new Geocoder($this->curl, $this->location);
	}

	public function testGetCoordinatesFromQuery()
	{
		$this->setupMocks();
		$result = $this->geocoder->getCoordinatesFromQuery($this->query);

		$this->assertEquals($this->coordinateResult, $result);
	}

	public function testGetLocationFromQuery()
	{
		$this->setupMocks();
		$result = $this->geocoder->getLocationFromQuery($this->query);

		$this->assertEquals($this->locationResult, $result);
	}

	public function testGetSearchSquare()
	{
		$result = $this->geocoder->getSearchSquare($this->coordinateResult, 5);

		$this->assertEquals($this->coordinateSquareResult, $result);
	}

	protected function setupMocks()
	{
		$this->curl->shouldReceive('get')
			->with('http://maps.googleapis.com/maps/api/geocode/json', m::type('Array'))
			->once()
			->andReturn($this->response);

		$this->location->shouldReceive('newInstanceFromObject')
			->with(m::type('StdClass'))
			->once()
			->andReturn($this->locationResult);
	}
}
