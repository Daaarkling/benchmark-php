<?php


namespace Benchmark\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCommand extends Command
{
	protected function configure()
	{
		$this->setName('benchmark:validate')
			->setDescription('Validate config file')
			->setHelp('Validate config file if it matches jason schema. Check if test data file exists and also check given test classes and converters if they exist and are instantiable.');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{

	}


}