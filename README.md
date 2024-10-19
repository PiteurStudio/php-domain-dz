# PHP Client for Nic.dz 

![image](https://github.com/user-attachments/assets/eec9edd7-19d4-479d-8824-97b1d6ebb123)


[![Latest Version on Packagist](https://img.shields.io/packagist/v/piteurstudio/php-nicdz.svg?style=flat-square)](https://packagist.org/packages/piteurstudio/php-nicdz)
[![Tests](https://img.shields.io/github/actions/workflow/status/PiteurStudio/php-domain-dz/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/PiteurStudio/php-domain-dz/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/piteurstudio/php-nicdz?style=flat-square)](https://packagist.org/packages/piteurstudio/php-nicdz)

**PHP Client for Nic.dz** provides an easy-to-use interface for checking .dz domains through the official [nic.dz Public API](https://api.nic.dz/swagger-ui/index.html). 

Effortlessly check domain availability or retrieve detailed WHOIS information for `.dz` domain extensions.

## Requirements

- PHP 8.0 or higher

## Installation

Install the package via Composer:

```bash
composer require piteurstudio/php-nicdz
```

## Usage

### Domain Availability Check

Easily verify if a `.dz` domain is available:



```php
use PiteurStudio\NicDz;

include 'vendor/autoload.php';

$domainChecker = new NicDz('example-domain.dz');

$isAvailable = $domainChecker->isAvailable(); // Returns boolean: true if available, false otherwise
```

Note: The package supports valid `.dz` extensions including: `.gov.dz`, `.org.dz`,  `.com.dz`, `.net.dz`, `.edu.dz`, `.asso.dz`, `.pol.dz`, `.art.dz`, `.soc.dz`, `.tm.dz` .

### Retrieving WHOIS Information

Get detailed WHOIS information in various formats:

```php
$domainChecker = new NicDz('piteur-studio.dz');

// As an array
$whoisDataArray = $domainChecker->whois()->toArray();

// As an object
$whoisDataObject = $domainChecker->whois()->toObject();

// As a raw string
$whoisDataString = $domainChecker->whois()->toString();

// As JSON
$whoisDataJson = $domainChecker->whois()->toJson();

```

## Testing

Run the tests with:


```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Disclaimer

This package is not officially affiliated with or endorsed by **nic.dz**. The NIC.dz name, logo, and trademarks are the property of **nic.dz**.

## Credits

- [Piteur Studio](https://github.com/PiteurStudio)
- [All Contributors](../../contributors)

## License

This package is open-sourced software licensed under the [MIT License.](LICENSE.md).
