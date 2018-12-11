<?php
/**
 * Created by IntelliJ IDEA.
 * User: tri
 * Date: 9/21/17
 * Time: 8:44 AM
 */

namespace app\helpers;


class Logistic
{
    /**
     * Distance between 2 points
     * @param $point1_lat
     * @param $point1_long
     * @param $point2_lat
     * @param $point2_long
     * @param string $unit
     * @param int $decimals
     * @return float Distance between point 1 and point 2
     */
    public static function distance_latlng($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'mi', $decimals = 2)
    {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));
        $distance = NAN;
        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch ($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                break;
            case 'nmi':
                $distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }
}