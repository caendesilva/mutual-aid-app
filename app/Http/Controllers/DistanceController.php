<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kolirt\Openstreetmap\Facade\Openstreetmap as OSM;

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
    public float $lat1;

    /**
     * The point A longitude
     * @var float λ1
     */
    public float $long1;

    /**
     * The point B latitude
     * @var float φ2
     */
    public float $lat2;

    /**
     * The point B longitude
     * @var float λ2
     */
    public float $long2;

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
    public function __construct(string $pointA, string $pointB)
    {
        $mapDataA = $this->OSMSearch($pointA);
        $this->lat1  = $mapDataA->lat;
        $this->long1  = $mapDataA->lon;

        $mapDataB = $this->OSMSearch($pointB);
        $this->lat2  = $mapDataB->lat;
        $this->long2  = $mapDataB->lon;

        $this->distance = $this->calculate();

        $this->results = [
            'meters' => $this->distance,
            'metersRounded' => round($this->distance),
            'kilometers' => $this->distance / 1000,
            'kilometersRounded' => round($this->distance / 1000),
            'miles' => ($this->distance * 0.00062137),
            'milesRounded' => round($this->distance * 0.00062137),
        ];
    }

    /**
     * Get the calculated array.
     *
     * @return array
     */
    public function get()
    {
        return $this->results;
    }

    /**
     * Get the result in miles
     */
    public function getMiles()
    {
        return $this->results['miles'];
    }

    /**
     * Get the result in kilometers
     */
    public function getKilometers()
    {
        return $this->results['kilometers'];
    }

    /**
     * Conduct the OSM search and return the results object
     */
    private function OSMSearch(string $search)
    {
        $result = OSM::search($search, 1);
        if (!$result) {
            return [0, 0];
        }

        return $result[0];
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
     *
     * To learn more about geo-coordinates, see
     * https://enlear.academy/working-with-geo-coordinates-in-mysql-5451e54cddec
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

    /**
     * Calculate the distance using a more readable Haversine formula
     *
     * @see https://en.wikipedia.org/wiki/Haversine_formula
     * @see https://www.movable-type.co.uk/scripts/latlong.html for further reading
     *
     * @example DistanceController::calculateHaversine(51.5, 0.1167, 40.66, 73.94);
     *
     * @param float $lat1  Latitude  of Point A (φ1)
     * @param float $long1 Longitude of Point B (λ1)
     * @param float $lat2  Latitude  of Point B (φ2)
     * @param float $long2 Longitude of Point B (λ2)
     *
     * @return float $distance in meters
     */
    public static function calculateHaversine(float $lat1, float $long1, float $lat2, float $long2): float
    {
        $phi1 = deg2rad($lat1);
        $phi2 = deg2rad($lat2);
        $lambda1 = deg2rad($long1);
        $lambda2 = deg2rad($long2);

        $phiDelta = $phi2 - $phi1;
        $lambdaDelta = $lambda2 - $lambda1;
        
        $phiHaversine = pow((sin($phiDelta / 2)), 2);
        $lambdaHaversine = pow((sin($lambdaDelta / 2)), 2);

        $angle = (2 * asin(sqrt($phiHaversine + cos($phi1) * cos($phi2) * $lambdaHaversine)));
        
        $distance = $angle * (self::EARTH_RADIUS * 1000);

        return $distance;
    }
}
