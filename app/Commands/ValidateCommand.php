<?php


namespace Darkling\Benchmark\Commands;


use Darkling\Benchmark\Utils\Validator;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ValidateCommand extends Command
{
	const OUTPUT = ['file', 'csv', 'console', 'dump'];



	protected function configure()
	{
		$this->setName('benchmark:validate')
			->setDescription('Validate config file')
			->setHelp('Validate config file against the schema. Check if test data file exists and also check given classes and converters if they exist and are instantiable.')
			->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Set different config file (must by located in config folder).', 'config.json')
			->addOption('data', 'd', InputOption::VALUE_REQUIRED, 'Set different test data (must by located in config folder).', 'testData.json');
	}



	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		$configFileName = $input->getOption('config');
		$configFile = __DIR__ . '/../../config/' . $configFileName;
		if (!file_exists($configFile)) {
			$io->error('Config file was not found nor given.');
			return 1;
		}

		$config = Json::decode(file_get_contents($configFile));

		$testDataFileName = $input->getOption('data');
		$config->testData = $testDataFileName;

		$validator = new Validator($config);
		$validator->validate();


		if ($validator->isValid()) {
			$io->title('Validation looks great!');
			return 0;
		}

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