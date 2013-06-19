[![Build Status](https://travis-ci.org/rtablada/geocoder.png?branch=master)](http://travis-ci.org/rtablada/geocoder)

# Geocoder

This is a simple geocode provider for PHP. By default, it uses google's geocode API but any compatible API will work.

# Installation

This package can be installed using composer using `composer require rtablada/geocoder`.

For Laravel 4, this package and its Service Provider can be installed using `php artisan package:install rtablada/geocoder`.

On both, specify `dev-master` as the version constraint.

# Use

To use this package outside of Laravel you can use

```php
require 'vendor/autoload.php';

$geocoder = new Rtablada\Geocoder\Geocoder;

var_dump($geocoder->getLocationFromQuery('Atlanta'));
```

The geocoder provides the following functions

<table>
	<tr>
		<th>Function</th>
		<th>Arguments</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>getLocationFromQuery</td>
		<td>string Query</td>
		<td>Returns a Location Object from the google geocode API</td>
	</tr>
	<tr>
		<td>getCoordinatesFromQuery</td>
		<td>string Query</td>
		<td>Returns a Coordinates Object from the google geocode API</td>
	</tr>
	<tr>
		<td>getSearchSquare</td>
		<td>Coordinate center, number radius</td>
		<td>Returns an array with the corners of a sqare around the centerpoint with a radius in miles</td>
	</tr>
</table>


# Other Provided Classes

The Geocoder Package also provides two helper classes (Location and Coordinate).

The Coordinate is a simple object with `lat` and `lng` properties.

The Location object has `address` and `coordinates` properties. The `coordinates` is an instance of the Coordinate class.

The Location class also provides a `newInstanceFromObject` method to parse Google Geocode Result objects into Location objects.
