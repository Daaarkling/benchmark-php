<?php
namespace Benchmark\Commands;


use Benchmark\Benchmark;
use Benchmark\BenchmarkTableOutput;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{


	protected function configure()
	{
		$this->setName('benchmark:run')
			->setDescription('Run benchmark with given config and test data.')
			->setHelp('help me')
			->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Set different config file (must by located in config folder).', 'config.json')
			->addOption('data', 'd', InputOption::VALUE_REQUIRED, 'Set different test data (must by located in config folder).', 'testData.json')
			->addOption('repetitions', 'r', InputOption::VALUE_REQUIRED, 'Set number of repetitions', 10);
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

		$config = Json::decode(file_get_contents($configFile), Json::FORCE_ARRAY);

		$testDataFileName = $input->getOption('data');
		$config['testData'] = $testDataFileName;

		$repetitions = $input->getOption('repetitions');
		if (!is_numeric($repetitions) || $repetitions <= 0) {
			$io->error('Number of repetitions must be greater then zero.');
			return 1;
		}
		$config['repetitions'] = $repetitions;


		// run validation command
		$validateCommand = $this->getApplication()->find('benchmark:valid');
		$arguments = [
			'command' => 'benchmark:valid',
			'--config' => $configFileName,
			'--data' => $testDataFileName,
		];
		$returnCode = $validateCommand->run(new ArrayInput($arguments), $output);

		// validation is OK
		if ($returnCode === 0) {
			$benchmark = new BenchmarkTableOutput($config, $io);
			$benchmark->run();
			$io->title('Benchmark was done successfully!');
			return $returnCode;
		}
		return 1;
	}
}