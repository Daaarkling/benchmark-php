<?php

namespace Benchmark\Commands;


use Benchmark\BenchmarkConsoleOutput;
use Benchmark\BenchmarkCsvOutput;
use Benchmark\BenchmarkDumpOutput;
use Benchmark\BenchmarkFileOutput;
use Nette\Utils\Json;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
	const OUTPUT_FILE = 'file';
	const OUTPUT_CSV = 'csv';
	const OUTPUT_CONSOLE = 'console';
	const OUTPUT_DUMP = 'dump';
	const OUTPUTS = [self::OUTPUT_FILE, self::OUTPUT_CSV, self::OUTPUT_CONSOLE, self::OUTPUT_DUMP];



	protected function configure()
	{
		$this->setName('benchmark:run')
			->setDescription('Run benchmark with given config and test data.')
			->setHelp('First run validation any potential errors are shown in console. Then proceed to benchmark itself. You can choose from several options how to handle result: ' . implode(', ', self::OUTPUTS) . '.')
			->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Set config file (must by located in config folder).', 'config.json')
			->addOption('data', 'd', InputOption::VALUE_REQUIRED, 'Set test data (must by located in config folder).')
			->addOption('repetitions', 'r', InputOption::VALUE_REQUIRED, 'Set number of repetitions')
			->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'Set output. You can choose from several choices: ' . implode(', ', self::OUTPUTS) . '.', 'console');
	}



	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$io = new SymfonyStyle($input, $output);

		// config
		$configFileName = $input->getOption('config');
		$configFile = __DIR__ . '/../../config/' . $configFileName;
		if (!file_exists($configFile)) {
			$io->error('Config file was not found nor given.');
			return 1;
		}

		$config = Json::decode(file_get_contents($configFile), Json::FORCE_ARRAY);


		// test data
		$testDataFileName = $input->getOption('data');
		if ($testDataFileName !== NULL){
			$config['testData'] = $testDataFileName;
		}


		// repetitions
		$repetitions = $input->getOption('repetitions');
		if ($repetitions !== NULL) {
			$config['repetitions'] = $repetitions;
		}


		// output
		$outputOption = $input->getOption('output');
		if (!in_array($outputOption, self::OUTPUTS)) {
			$io->error('Output must be one of these options: ' . implode(', ', self::OUTPUTS));
			return 1;
		}


		// run validation command
		$validateCommand = $this->getApplication()->find('benchmark:valid');
		$arguments = [
			'command' => 'benchmark:valid',
			'--config' => $configFileName,
			'--data' => $config['testData'],
		];

		$returnCode = $validateCommand->run(new ArrayInput($arguments), $output);

		// validation is OK
		if ($returnCode === 0) {

			if ($outputOption === self::OUTPUT_FILE) {
				$bufferedOutput = new BufferedOutput();
				$benchmark = new BenchmarkFileOutput($config, $input, $bufferedOutput);
			}
			elseif ($outputOption === self::OUTPUT_DUMP) {
				$benchmark = new BenchmarkDumpOutput($config);
			}
			elseif ($outputOption === self::OUTPUT_CSV) {
				$benchmark = new BenchmarkCsvOutput($config);
			}
			else {
				$benchmark = new BenchmarkConsoleOutput($config, $input, $output);
			}

			$benchmark->run();
			$io->title('Benchmark processed successfully!');
			return $returnCode;
		}
		return 1;
	}
}