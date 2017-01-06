<?php


namespace Benchmark;


use DateTime;
use DateTimeZone;
use Nette\Utils\FileSystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;

class BenchmarkFileOutput extends BenchmarkConsoleOutput
{
	/** @var string */
	public static $fileName = 'php-output';

	/** @var string */
	public static $timeFormat = 'Y-m-d-H-i-s';


	/** @var BufferedOutput */
	protected $output;


	public function __construct(Config $config, InputInterface $input, BufferedOutput $output)
	{
		parent::__construct($config, $input, $output);
	}


	protected function handleResult($result)
	{
		parent::handleResult($result);

		$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);
		$name = __DIR__ . '/../output/' . self::$fileName . '-' . $time . '.txt';

		FileSystem::write($name, $this->output->fetch());
	}
}