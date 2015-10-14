# Streak PHP Client

Simple PHP client for [Streak API](https://www.streak.com/api/)

## Installation

```
$ composer require xotelia/streak-php-client
```

## Usage

```php
<?php

use Streak\Streak;

$apiKey = 'your api key';
$streak = new Streak($apiKey);
$me = $streak->users()->me();
```
