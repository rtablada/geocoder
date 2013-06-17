<?php namespace Rtablada\Geocoder;

use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['geocoder'] = $this->app->share(function($app)
        {
            $location = new Location;
            $curl = new \Curl;

            return new Geocoder($curl, $location);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('geocoder');
	}

}
