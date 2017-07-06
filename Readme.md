# Logbook
> Log your daily activities

Ever wanted to just write down what you have to do that day and at the end of the day write what you did?
Ever wanted to remember what you wrote down?

This web app logs all that.

## Requirements

* PHP 7+
* MySQL/MariaDB
* PDO extension
* Composer
* NPM (optional)

## Installing

Clone where you want to host this app.
Make the public folder the web access root.
run:
```shell
composer install
```

If you want to change less files, after the changes run:
```shell
npm run production
```

## Features

* Program the week and the day.
* Record what you did all day.

## Configuration

Everything in the config folder is changeable to your settings.

### app.php

General settings.

#### timezone
Type: `String`
Default: `'America/New_York'`

Timezone string acording to [PHP](http://php.net/manual/en/timezones.php) for [Carbon](http://carbon.nesbot.com/) ([DateTime](http://php.net/manual/en/class.datetime.php)).

#### language
Type: `String`
Default: `'en'`

Two character code for [language](https://www.w3schools.com/tags/ref_language_codes.asp). The json file in the language dir is created with the phrases needed for the translation if it doesn't exist.

#### locale
Type: `String`
Default: `'en-US'`

[PHP locale](http://php.net/manual/en/class.locale.php) string for the weekday representation.

### database.php

Database settings. This app uses PDO extension.

#### type
Type: `String`
Default: `'mysql'`

Database type.

#### host
Type: `String`
Default: `'localhost'`

Connection host.

#### port
Type: `Integer`
Default: `3306`

Connection port.

#### name
Type: `String`
Default: `'logbook'`

Database name.

#### username
Type: `String`
Default: `'user'`

#### password
Type: `String`
Default: `'password'`

### locations.php

Where is everything located

#### base-dir
Type: `String`
Default: `dirname(__DIR__)`

#### public-dir
Type: `String`
Default: `'{locations.base-dir}/public'`

#### resource-dir
Type: `String`
Default: `'{locations.base-dir}/resources'`

#### source-dir
Type: `String`
Default: `'{locations.base-dir}/src'`

#### test-dir
Type: `String`
Default: `'{locations.base-dir}/tests'`

#### template-dir
Type: `String`
Default: `'{locations.resource-dir}/views'`

#### cache-dir
Type: `String`
Default: `'{locations.base-dir}/cache'`

#### cli-dir
Type: `String`
Default: `'{locations.base-dir}/cli'`

#### language-dir
Type: `String`
Default: `'{locations.base-dir}/languages'`
