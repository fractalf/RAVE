#!/bin/sh
phpunit --bootstrap $(dirname $0)/bootstrap.php $(dirname $0)/ApiTest.php
