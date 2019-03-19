# Streak PHP Client

[![Build Status](https://travis-ci.org/Xotelia/streak-php-client.svg)](https://travis-ci.org/Xotelia/streak-php-client) [![Latest Stable Version](https://poser.pugx.org/xotelia/streak-php-client/v/stable)](https://packagist.org/packages/xotelia/streak-php-client) [![Total Downloads](https://poser.pugx.org/xotelia/streak-php-client/downloads)](https://packagist.org/packages/xotelia/streak-php-client) [![License](https://poser.pugx.org/xotelia/streak-php-client/license)](https://packagist.org/packages/xotelia/streak-php-client) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Xotelia/streak-php-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Xotelia/streak-php-client/?branch=master)

Simple PHP client for [Streak API](https://www.streak.com/api/)

Special forked version to add Team endpoint and adjust code to swap between V1 and V2 of Streak API depending on the Endpoint.

## Installation

```
$ composer require xotelia/streak-php-client
```

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Streak\Streak;

$apiKey = 'your api key';
$streak = new Streak($apiKey);
$me = $streak->users()->me();
```
