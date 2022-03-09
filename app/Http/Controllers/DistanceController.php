<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Calculate the distance between two points
 * Requires the points to be sets of coordinates,
 * and includes a helper to convert a ZIP code to GPS.
 */
class DistanceController extends Controller
{
    /**
     * The Earth radius used for calculations.
     * Based on the WGS 84 datum surface which has
     * an equatorial radius (a) of 6 378 137 meters 
     */
    public const EARTH_RADIUS = 6378.137;

    /**
     * The point A latitude
     * @var float φ1
     */
    public float $lat1 = 59.3293;

    /**
     * The point A longitude
     * @var float λ1
     */
    public float $long1 = 18.0686;

    /**
     * The point B latitude
     * @var float φ2
     */
    public float $lat2 = 51.5072;

    /**
     * The point B longitude
     * @var float λ2
     */
    public float $long2 = 0.1276;

    /**
     * Coordinate array of point A 
     * @var array [φ1, λ1]
     */
    public array $tup1;

    /**
     * Coordinate array of point B 
     * @var array [φ2, λ2]
     */
    public array $tup2;

    /**
     * The calculated distance in meters.
     * @var float
     */
    public float $distance;

    /**
     * An array of the calculated distance in varying formats.
     * @var array
     */
    public array $results;

    /**
     * Construct the class.
     */
    public function __construct(float $lat1 = 59.3293, float $lat2 = 18.0686, float $long1 = 51.5072, float $long2 = 0.1276) {
        $this->lat1  = $lat1;
        $this->lat2  = $lat2;
        $this->long1 = $long1;
        $this->long2 = $long2;

        $this->tup1 = [$this->lat1, $this->long1];
        $this->tup2 = [$this->lat2, $this->long2];
    }

    /**
     * Get the calculated array.
     * 
     * @return array
     */
    public function get()
    {
        $this->distance = $this->calculate();

        $this->results = [
            'meters' => $this->distance,
            'metersRounded' => round($this->distance),
            'kilometers' => $this->distance / 1000,
            'kilometersRounded' => round($this->distance / 1000),
            'miles' => ($this->distance * 0.00062137),
            'milesRounded' => round($this->distance * 0.00062137),
        ];

        return $this->results;
    }

    /**
     * Set the coordinates from an array
     * Must follow format [φ1, λ1, φ2, λ2]
     */
    public function fromArray(array $array)
    {
        $this->lat1  = $array[0];
        $this->lat2  = $array[1];
        $this->long1 = $array[2];
        $this->long2 = $array[3];

        $this->tup1 = [$array[0], $array[1]];
        $this->tup2 = [$array[2], $array[3]];

        return $this;
    }

    /**
     * Calculate the distance between two GCS tuples
     * 
     * The base formula is from Amy (user v-xicai) at Microsoft BI and is as follows
     * =acos(sin(lat1)*sin(lat2)+cos(lat1)*cos(lat2)*cos(lon2-lon1))*6371 (where 6371 is Earth radius in km.)
     * 
     * And thanks to https://stackoverflow.com/a/49212829/5700388 (with the great quote "education never seems like a waste of time")
     * we know that distance = earth radius * radians.
     * 
     * Note that the coordinate trigonometric arguments are in degrees, but the arccosine result
     * in the formula returns radians which we multiply with the Earth radius to get the distance.
     */
    public function calculate(): float
    {
        // Convert the degree values to radians
        $lat1 = deg2rad($this->lat1);
        $lat2 = deg2rad($this->lat2);
        $long1 = deg2rad($this->long1);
        $long2 = deg2rad($this->long2);

        // Return the result of the formula in meters
        return acos(sin($lat1)*sin($lat2)+cos($lat1)*cos($lat2)*cos($long2-$long1))*self::EARTH_RADIUS * 1000;
    }
}
