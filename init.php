<?php

use Composer\Autoload\ClassLoader;
use Darkling\Benchmark\Commands\RunCommand;
use Darkling\Benchmark\Commands\ValidateCommand;
use Nette\Caching\Storages\FileStorage;
use Nette\Loaders\RobotLoader;
use Symfony\Component\Console\Application;


/** @var ClassLoader $composer */
$composer = require __DIR__ . '/vendor/autoload.php';

$loader = new RobotLoader;
$loader->addDirectory('app');
$loader->setCacheStorage(new FileStorage('temp'));
//$loader->setTempDirectory('temp');
$loader->register();


$app = new Application();
$app->add(new RunCommand());
$app->add(new ValidateCommand());
$app->run();