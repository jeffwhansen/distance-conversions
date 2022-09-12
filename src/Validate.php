<?php

namespace Jeffwhansen\DistanceConversions;

class Validate
{
    /*
     * Allow the following formats
     * .5
     * 5
     * 5.5
     * 5.55
     */
    public static function metric(float $distance)
    {
        return (bool) preg_match("/^[0-9]+?(\.[0-9][0-9][0-9]?)?$/", $distance);
    }

    /*
     * Allow the following formats
     * 18
     * 18-2
     * 18-0.5
     * 18-2.75
     */
    public static function english(float|string $distance)
    {
        return (bool) preg_match("/^[0-9]+?(\-([0-9]|10|11)?(\.(0|5|25|50|75)?)?)?$/", $distance);
    }
}
