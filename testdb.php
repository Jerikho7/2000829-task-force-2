<?php

require_once 'vendor/autoload.php';

use TaskForce\classes\Additions\CsvToSqlTranslation;

$categories = new CsvToSqlTranslation('./data/categories.csv', ['name', 'icon']);

$categories->importCsv();
$categories->generateSqlFile('categories');

$cities = new CsvToSqlTranslation('./data/cities.csv', ['name', 'lat', 'lng']);

$cities->importCsv();
$cities->generateSqlFile('cities');
