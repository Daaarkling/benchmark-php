<?php

use Benchmark\Commands\RunCommand;
use Benchmark\Commands\ValidateCommand;
use Composer\Autoload\ClassLoader;
use Nette\Loaders\RobotLoader;
use Nette\Caching\Storages\FileStorage;
use Symfony\Component\Console\Application;


/** @var ClassLoader $composer */
$composer = require __DIR__ . '/vendor/autoload.php';

$loader = new RobotLoader;
$loader->addDirectory('benchmark');
$loader->setCacheStorage(new FileStorage('temp'));
$loader->register();


$app = new Application();
$app->add(new RunCommand());
$app->add(new ValidateCommand());
$app->run();