<?php


namespace Benchmark\Commands;


use Benchmark\Utils\Validator;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ValidateCommand extends Command
{


	protected function configure()
	{
		$this->setName('benchmark:validate')
			->setDescription('Validate config file')
			->setHelp('Validate config file against the schema. Check if test data file exists and also check given classes and converters if they exist and are instantiable.')
			->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Set different config file.')
			->addOption('repetitions', 'r', InputOption::VALUE_REQUIRED, 'Set number of repetitions')
			->addOption('data', 'd', InputOption::VALUE_REQUIRED, 'Set test data.');
	}



	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		// config
		$configGiven = $input->getOption('config');
		if ($configGiven !== NULL && ($configReal = realpath($configGiven))) {
			$configFile = $configReal;
		} elseif (($configReal = realpath(Validator::$configFile))) {
			$configFile = $configReal;
		} else {
			$io->error('Config file was not found nor given.');
			return 1;
		}
		$config = Json::decode(file_get_contents($configFile));


		// repetitions
		$repetitions = $input->getOption('repetitions');
		if ($repetitions !== NULL) {
			$config->repetitions = (int) $repetitions;
		}


		// test data
		$testDataFileName = $input->getOption('data');
		if ($testDataFileName !== NULL && ($realPath = realpath($testDataFileName))){
			$config->testData = $realPath;
		} elseif (($realPath = realpath(Validator::$testDataFile))) {
			$config->testData = $realPath;
		} else {
			$io->error('Test data file was not found nor given.');
			return 1;
		}


		// validation
		$validator = new Validator($config);
		$validator->validate();


		// ok
		if ($validator->isValid()) {
			$io->title('Validation passed!');
			return 0;
		}

		// errors
		foreach ($validator->getErrors() as $type => $errors) {
			$io->section($type);
			foreach ($errors as $error) {
				$io->error(sprintf("'%s' %s", $error['property'], $error['message']));
			}
		}
		$io->text('Config file contains errors!');
		return 1;
	}


}