# Logbook
> Log your day activities

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

Timezone string acording to PHP for Carbon (DateTime).

#### language
Type: `String`
Default: `'en'`

Two character code for language. The json file in the language dir is created with the phrases needed for the translation if it doesn't exist.

#### locale
Type: `String`
Default: `'en-US'`

PHP locale string for the weekday representation.

### database.php

Database settings. This app uses PDO extension.
