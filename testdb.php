<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskForce\classes\Additions\CsvToSqlTranslation;

$categories = new CsvToSqlTranslation("../data/categories.csv", ['name', 'icon']);

$categories->importCsv();
$categories->generateSqlFile('categories');

