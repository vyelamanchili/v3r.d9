composer/semver
===============

Semver library that offers utilities, version constraint parsing and validation.

Originally written as part of [composer/composer](https://github.com/composer/composer),
now extracted and made available as a stand-alone library.

<<<<<<< Updated upstream
[![Build Status](https://travis-ci.org/composer/semver.svg?branch=master)](https://travis-ci.org/composer/semver)

=======
[![Continuous Integration](https://github.com/composer/semver/actions/workflows/continuous-integration.yml/badge.svg?branch=main)](https://github.com/composer/semver/actions/workflows/continuous-integration.yml)
[![PHP Lint](https://github.com/composer/semver/actions/workflows/lint.yml/badge.svg?branch=main)](https://github.com/composer/semver/actions/workflows/lint.yml)
[![PHPStan](https://github.com/composer/semver/actions/workflows/phpstan.yml/badge.svg?branch=main)](https://github.com/composer/semver/actions/workflows/phpstan.yml)
>>>>>>> Stashed changes

Installation
------------

Install the latest version with:

```bash
composer require composer/semver
```


Requirements
------------

* PHP 5.3.2 is required but using the latest version of PHP is highly recommended.


Version Comparison
------------------

For details on how versions are compared, refer to the [Versions](https://getcomposer.org/doc/articles/versions.md)
article in the documentation section of the [getcomposer.org](https://getcomposer.org) website.


Basic usage
-----------

### Comparator

The `Composer\Semver\Comparator` class provides the following methods for comparing versions:

* greaterThan($v1, $v2)
* greaterThanOrEqualTo($v1, $v2)
* lessThan($v1, $v2)
* lessThanOrEqualTo($v1, $v2)
* equalTo($v1, $v2)
* notEqualTo($v1, $v2)

Each function takes two version strings as arguments. For example:

```php
use Composer\Semver\Comparator;

Comparator::greaterThan('1.25.0', '1.24.0'); // 1.25.0 > 1.24.0
```

### Semver

The `Composer\Semver\Semver` class provides the following methods:

* satisfies($version, $constraints)
* satisfiedBy(array $versions, $constraint)
* sort($versions)
* rsort($versions)


License
-------

composer/semver is licensed under the MIT License, see the LICENSE file for details.
