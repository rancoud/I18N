# I18N Package

![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/rancoud/i18n)
[![Packagist Version](https://img.shields.io/packagist/v/rancoud/i18n)](https://packagist.org/packages/rancoud/i18n)
[![Packagist Downloads](https://img.shields.io/packagist/dt/rancoud/i18n)](https://packagist.org/packages/rancoud/i18n)
[![Composer dependencies](https://img.shields.io/badge/dependencies-0-brightgreen)](https://github.com/rancoud/i18n/blob/master/composer.json)
[![Test workflow](https://img.shields.io/github/workflow/status/rancoud/i18n/test?label=test&logo=github)](https://github.com/rancoud/i18n/actions?workflow=test)
[![Codecov](https://img.shields.io/codecov/c/github/rancoud/i18n?logo=codecov)](https://codecov.io/gh/rancoud/i18n)
[![composer.lock](https://poser.pugx.org/rancoud/i18n/composerlock)](https://packagist.org/packages/rancoud/i18n)

I18N.

## Installation
```php
composer require rancoud/i18n
```

## How to use it?
You need a file `LANG.php` where LANG is the filename.  
It will contains an array key values:
```php
return [
    'Hello' => 'Bonjour'
];
```
You have to set the default directory and language
```php
$defaultDirectory = '/path/to/translations/';
$defaultLanguage = 'en';
I18N::setDefaults($directory, $defaultLanguage);
```
In action:
```php
I18N::echo('Hello');
// it will produce in output 'Hello'

I18N::echo('another string');
// it will produce in output 'another string' because the key doesn't exist in the file

$string = I18N::get('Hello');
// it will return 'Hello'

// you can use different language file instead of the default one
$string = I18N::get('string in other lang', 'es');
// it will return the translation of 'string in other lang' present in the es.php file
```

## I18N Methods
### General static Commands
* setDefaults(directory: string, language: string):void
* echo(key: string, [language: string = null]):void
* get(key: string, [language: string = null]):string

## How to Dev
`composer ci` for php-cs-fixer and phpunit and coverage  
`composer lint` for php-cs-fixer  
`composer test` for phpunit and coverage