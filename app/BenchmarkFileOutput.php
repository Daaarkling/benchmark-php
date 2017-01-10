<?php


namespace Benchmark;


use DateTime;
use DateTimeZone;
use Nette\Utils\FileSystem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

class BenchmarkFileOutput extends BenchmarkConsoleOutput
{
	/** @var string */
	public static $fileName = 'php-output';

	/** @var BufferedOutput */
	protected $output;

	/** @var string */
	private $outputDir;


	public function __construct(Config $config, InputInterface $input, BufferedOutput $output, $outputDir)
	{
		parent::__construct($config, $input, $output);
		$this->outputDir = $outputDir;
	}

	protected function printTable($caption, $headers, $rows)
	{
		$io = new SymfonyStyle($this->input, $this->output);
		$io->title($caption);
		$io->table($headers, $rows);

		$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);
		$name = __DIR__ . '/../output/' . self::$fileName . '-' . $time . '.txt';

		FileSystem::write($name, $this->output->fetch());
	}


}