<?php

use Jeffwhansen\DistanceConversions\Distance;
use Jeffwhansen\DistanceConversions\Format;

it('can convert 5.55 from metric to english', function () {
    $result = Distance::fromMeters("5.55")->to(Format::ENGLISH);
    expect($result)->toEqual("18-2.5");
});

it('can convert 5.55 from metric to english using the toEnglish helper', function () {
    $result = Distance::fromMeters("5.55")->toEnglish();
    expect($result)->toEqual("18-2.5");
});

it('can convert 5.5 from metric to english', function () {
    $result = Distance::fromMeters("5.5")->to(Format::ENGLISH);
    expect($result)->toEqual("18-0.5");
});

it('can convert 5 from metric to english', function () {
    $result = Distance::fromMeters("5")->to(Format::ENGLISH);
    expect($result)->toEqual("16-4.75");
});

it('can convert 0 from metric to english', function () {
    $result = Distance::fromMeters(0)->to(Format::ENGLISH);
    expect($result)->toEqual(0);
});

it('can convert 0-0.0 from english to metric', function () {
    $result = Distance::fromFeet("0-0.0")->to(Format::METRIC);
    expect($result)->toEqual(0);
});

it('can convert 18 from english to metric', function () {
    $result = Distance::fromFeet(18)->to(Format::METRIC);
    expect($result)->toEqual(5.486);
});

it('can convert "18" from english to metric', function () {
    $result = Distance::fromFeet("18")->to(Format::METRIC);
    expect($result)->toEqual(5.486);
});

it('can convert "18-2" from english to metric', function () {
    $result = Distance::fromFeet("18-2")->to(Format::METRIC);
    expect($result)->toEqual(5.537);
});

it('can convert "18-2.5" from english to metric', function () {
    $result = Distance::fromFeet("18-2.5")->to(Format::METRIC);
    expect($result)->toEqual(5.55);
});

it('can convert "18-11.75" from english to metric', function () {
    $result = Distance::fromFeet("18-11.75")->to(Format::METRIC);
    expect($result)->toEqual(5.785);
});

it('can convert "18-2.5" from english to metric using toMetric helper', function () {
    $result = Distance::fromFeet("18-2.5")->toMetric();
    expect($result)->toEqual(5.55);
});

it('throws exception if 18-22 is passed for fromFeet', function () {
    Distance::fromFeet("18-22")->to(Format::METRIC);
})->throws(Exception::class);

it('throws exception if 5.555 is passed for fromMeters', function () {
    Distance::fromFeet(5.555)->to(Format::METRIC);
})->throws(Exception::class);
