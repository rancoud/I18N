# I18N Package

[![Build Status](https://travis-ci.org/rancoud/I18N.svg?branch=master)](https://travis-ci.org/rancoud/I18N) [![Coverage Status](https://coveralls.io/repos/github/rancoud/I18N/badge.svg?branch=master)](https://coveralls.io/github/rancoud/I18N?branch=master)

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
`./run_all_commands.sh` for php-cs-fixer and phpunit and coverage  
`./run_php_unit_coverage.sh` for phpunit and coverage  