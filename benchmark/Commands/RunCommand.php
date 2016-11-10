<?php


namespace Benchmark\Commands;


use Benchmark\Benchmark;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
	protected function configure()
	{
		$this->setName('benchmark:run')
			->setDescription('run benchmark')
			->setHelp('help me');
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

		$benchmark = new Benchmark($config);
		$benchmark->run();
	}


}