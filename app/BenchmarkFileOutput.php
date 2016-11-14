<?php


namespace Darkling\Benchmark;


use Nette\Utils\FileSystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;

class BenchmarkFileOutput extends BenchmarkConsoleOutput
{
	public static $fileName = 'output.txt';

	/** @var BufferedOutput */
	protected $output;


	public function __construct(array $config, InputInterface $input, BufferedOutput $output)
	{
		parent::__construct($config, $input, $output);
	}


	protected function handleResult($result)
	{
		parent::handleResult($result);

		FileSystem::write(__DIR__ . '/../output/' . self::$fileName, $this->output->fetch());
	}
}