# checks .dz domains via the nic.dz API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/piteurstudio/php-domain-dz.svg?style=flat-square)](https://packagist.org/packages/piteurstudio/php-domain-dz)
[![Tests](https://img.shields.io/github/actions/workflow/status/piteurstudio/php-domain-dz/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/piteurstudio/php-domain-dz/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/piteurstudio/php-domain-dz.svg?style=flat-square)](https://packagist.org/packages/piteurstudio/php-domain-dz)

This php packages checks .dz domains via the [nic.dz Public API](https://api.nic.dz/swagger-ui/index.html). 

## Installation

You can install the package via composer:

```bash
composer require piteurstudio/php-nicdz
```

## Usage

### Check if a domain is available

```php
use PiteurStudio\NicDz;

include 'vendor/autoload.php';

$dztld = new NicDz('example-domain.dz');

$dztld->isAvailable(); // return bool
```

### Get whois information in different formats

```php
$dztld = new NicDz('piteur-studio.dz');

$dztld->whois()->toArray();

$dztld->whois()->toObject();

$dztld->whois()->toString();

$dztld->whois()->toJson();

```

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

- [Piteur Studio](https://github.com/PiteurStudio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
