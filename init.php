<?php

use Benchmark\Commands\RunCommand;
use Benchmark\Commands\ValidateCommand;
use Composer\Autoload\ClassLoader;
use Nette\Caching\Storages\FileStorage;
use Nette\Loaders\RobotLoader;
use Symfony\Component\Console\Application;


/** @var ClassLoader $composer */
$composer = require __DIR__ . '/vendor/autoload.php';

$loader = new RobotLoader;
$loader->addDirectory(__DIR__ . '/app')
	->addDirectory(__DIR__ . '/libs')
	->setCacheStorage(new FileStorage(__DIR__ . '/temp'));
//$loader->setTempDirectory('temp');
$loader->register();


$converter = new \Benchmark\Converters\Avro\AvroConverter();
$converter->convertData(file_get_contents(__DIR__ . '/config/testdata.json'));


$app = new Application();
$app->add(new RunCommand());
$app->run();