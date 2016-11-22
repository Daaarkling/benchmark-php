<?php

use Composer\Autoload\ClassLoader;
use Benchmark\Commands\RunCommand;
use Benchmark\Commands\ValidateCommand;
use Nette\Caching\Storages\FileStorage;
use Nette\Loaders\RobotLoader;
use Symfony\Component\Console\Application;


/** @var ClassLoader $composer */
$composer = require __DIR__ . '/vendor/autoload.php';

$loader = new RobotLoader;
$loader->addDirectory('app')
	->addDirectory('libs')
	->setCacheStorage(new FileStorage('temp'));
//$loader->setTempDirectory('temp');
$loader->register();


$converter = new \Benchmark\Converters\Avro\AvroConverter();
$converter->convertData(file_get_contents(__DIR__ . '/config/testdata.json'));


$app = new Application();
$app->add(new RunCommand());
$app->add(new ValidateCommand());
$app->run();