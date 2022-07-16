<?php

namespace Jeffwhansen\DistanceConversions;

use Exception;

class Distance
{
    public const M = "Meters";
    public const C = "Centimeters";
    public const F = "Feet";
    public const I = "Inches"; //0-11
    public const p = "Inches partial as decimal"; //.25
    public const i = "Inches partial as fraction"; // 1/4
    public $possibleUnits = ['meters', 'feet'];

    public $asMetric;
    public $asEnglish;

    public static function fromMeters(float $meters): self
    {
        return new static($meters, 'meters');
    }

    public static function fromFeet(float|string $feet): self
    {
        return new static($feet, 'feet');
    }

    public function __construct(protected $distance, protected string $unit = 'meters')
    {
        if (! self::isValid()) {
            throw new Exception('Not a valid distance and unit combination provided.');
        }

        if ($this->unit == "meters") {
            $this->asMetric = $this->distance;
            $this->asEnglish = self::convertToEnglish($this->distance);
        }

        if ($this->unit == "feet") {
            $this->asEnglish = $this->distance;
            $this->asMetric = self::convertToMetric($this->distance);
        }
    }

    public function to($format)
    {
        if ($this->asMetric === 0.0) {
            return 0;
        }
        $str = '';
        $chars = str_split($format);
        foreach ($chars as $char) {
            switch ($char) {
                case("M"):
                    $str .= $this->meters();

                    break;
                case("C"):
                    $str .= $this->centimeters();

                    break;
                case("F"):
                    $str .= $this->feet();

                    break;
                case("I"):
                    $str .= $this->inches();

                    break;
                case("p"):
                    $str .= $this->inchesDecimal();

                    break;
                case("i"):
                    $str .= $this->inchesFraction();

                    break;
                default:
                    $str .= $char;
            }
        }

        return $str;
    }

    public function toMetric()
    {
        return $this->to(Format::METRIC);
    }

    public function toEnglish()
    {
        return $this->to(Format::ENGLISH);
    }

    public function meters()
    {
        $metersParts = explode(".", $this->asMetric);

        return $metersParts[0] ?: 0;
    }

    public function centimeters()
    {
        $metersParts = explode(".", $this->asMetric);
        if (isset($metersParts[1])) {
            return $metersParts[1];
        } else {
            return 0;
        }
    }

    public function feet()
    {
        $feetParts = explode("-", $this->asEnglish);

        return $feetParts[0] ?: 0;
    }

    public function inches()
    {
        $feetParts = explode("-", $this->asEnglish);
        if (isset($feetParts[1])) {
            $inchParts = explode(".", $feetParts[1]);
        }

        if (isset($inchParts[0])) {
            return $inchParts[0];
        }

        return 0;
    }

    public function inchesDecimal()
    {
        $feetParts = explode("-", $this->asEnglish);
        if (isset($feetParts[1])) {
            $inchParts = explode(".", $feetParts[1]);
        }

        if (isset($inchParts[1])) {
            return $inchParts[1];
        }

        return 0;
    }

    public function inchesFraction()
    {
        $feetParts = explode("-", $this->asEnglish);
        $inchParts = explode(".", $feetParts[1]);
        switch ($inchParts[1]) {
            case("25"):
                return "1/4";

                break;
            case("5"):
            case("50"):
                return "1/2";

                break;
            case(".75"):
                return "3/4";

                break;
            default:
                return;
        }
    }

    public function isValid()
    {
        if (! in_array($this->unit, $this->possibleUnits)) {
            throw new Exception('Invalid unit provided. Must be either "meter" or "feet".');
        }

        if ($this->unit == "meters") {
            return Validate::metric($this->distance);
        }
        if ($this->unit == "feet") {
            return Validate::english($this->distance);
        }
    }

    public function convertToMetric($value)
    {
        if (empty($value)) {
            return '0';
        }

        $splitVal = explode('-', $value);
        $feet = $splitVal[0];
        $inches = (isset($splitVal[1])) ? $splitVal[1] : 0;

        return round($feet * 0.3048 + floatval($inches) * 0.0254, 2);
    }

    public function convertToEnglish($value, $cmValue = null)
    {
        $cmVal = is_null($cmValue) ? 0 : $cmValue;

        $length = 100 * $value / 2.54 + $cmVal / 2.54;

        $feet = floor($length / 12);

        $inch = $length - 12 * $feet;
        $inchFractions = (round(($inch * 4))) / 4;

        $result = $feet . '-' . $inchFractions;

        return $result;
    }
}
