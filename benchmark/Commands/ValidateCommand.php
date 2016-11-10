<?php


namespace Benchmark\Commands;


use Benchmark\Validator;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ValidateCommand extends Command
{
	protected function configure()
	{
		$this->setName('benchmark:validate')
			->setDescription('Validate config file')
			->setHelp('Validate config file against the schema. Check if test data file exists and also check given classes and converters if they exist and are instantiable.');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		$configFile = __DIR__ . '/../../config/config.json';
		if (!file_exists($configFile)) {
			$io->error('Config file was not found nor given.');
			exit(1);
		}

		$config = Json::decode(file_get_contents(__DIR__ . '/../../config/config.json'), Json::FORCE_ARRAY);

		$validator = new Validator($config);
		$validator->validate();

		if ($validator->isValid()) {
			$io->title('Everything looks great!');
			exit(0);
		}



		foreach ($validator->getErrors() as $type => $errors) {
			$io->section($type);
			foreach ($errors as $error) {
				$io->error(sprintf("'%s' %s", $error['property'], $error['message']));
			}
		}
		$io->text('Config file contains errors!');
		exit(1);
	}


}