
# Distance conversions in PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffwhansen/distance-conversions.svg?style=flat-square)](https://packagist.org/packages/jeffwhansen/distance-conversions)
[![Tests](https://github.com/jeffwhansen/distance-conversions/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/jeffwhansen/distance-conversions/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffwhansen/distance-conversions.svg?style=flat-square)](https://packagist.org/packages/jeffwhansen/distance-conversions)

## Installation

You can install the package via composer:

```bash
composer require jeffwhansen/distance-conversions
```

## Usage

```php
Distance::fromMeters("5.55")->to(Format::ENGLISH); //18-2.5
Distance::fromFeet("18-2.5")->to(Format::METRIC); //5.55 
Distance::fromFeet("18-2.5")->to("M.C"); //5.55
Distance::fromMeters("5.55")->to("F' I-i\""); //18' 2-1/2"
```
### Format String Constants
You can format your output using the following placeholders.  Any character you provide  that is in not in the list will be literally printed in the response.

    const M = "Meters"; // 5
    const C = "Centimeters"; // 55
    const F = "Feet"; // 18
    const I = "Inches"; //0-11
    const p = "Inches partial as decimal"; //.25
    const i = "Inches partial as fraction"; // 1/4

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jeff Hansen](https://github.com/jeffwhansen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
