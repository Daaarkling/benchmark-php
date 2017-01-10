<?php


namespace Benchmark;


use Benchmark\Utils\Formatters;
use DateTime;
use DateTimeZone;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BenchmarkConsoleOutput extends Benchmark
{

	/** @var string */
	public static $timeFormat = 'Y-m-d-H-i-s';

	/** @var InputInterface */
	protected $input;

	/** @var OutputInterface */
	protected $output;

	
	
	public function __construct(Config $config, InputInterface $input, OutputInterface $output)
	{
		parent::__construct($config);
		
		$this->input = $input;
		$this->output = $output;
	}


	protected function handleResult($result)
	{
		if ($this->config->getMode() === Config::MODE_INNER) {
			$this->transformDataInner($result);
		} else {
			$this->transformDataOuter($result);
		}
	}



	protected function transformDataOuter($result) {

		$headers = ["Name", "Time - encode", "Time - decode", "Size"];
		$rows = [];

		foreach ($result as $typeName => $libs) {
			foreach ($libs as $metricResult) {
				$rows[] = [
					$typeName . ' - ' . $metricResult->getName(),
					$metricResult->hasEncode() ? Formatters::seconds($metricResult->getTimeEncode()[0]) : "---",
					$metricResult->hasDecode() ? Formatters::seconds($metricResult->getTimeDecode()[0]) : "---",
					$metricResult->hasEncode() ? Formatters::bytes($metricResult->getSize()) : "---",
				];
			}
		}

		$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);
		$this->printTable($time, $headers, $rows);
	}


	protected function transformDataInner($result) {

		$headersEncode = [];
		$headersDecode = [];
		$rowsEncode = [];
		$rowsDecode = [];
		$meanEncode = [];
		$meanDecode = [];
		$sizes = [];

		$count = $this->config->getRepetitions();
		for ($i = 0; $i < $count; $i++) {
			foreach ($result as $typeName => $libs) {
				foreach ($libs as $metricResult) {
					if ($i === 0) {
						// headers
						if ($metricResult->hasEncode()) {
							$headersEncode[] = $typeName . " - " . $metricResult->getName();
							$meanEncode[] = Formatters::seconds($metricResult->getMeanEncode());
							$sizes[] = Formatters::bytes($metricResult->getSize());
						}
						if ($metricResult->hasDecode()) {
							$headersDecode[] = $typeName . " - " . $metricResult->getName();
							$meanDecode[] = Formatters::seconds($metricResult->getMeanDecode());
						}
					}
					// times
					$sizeEncode = count($metricResult->getTimeEncode());
					if ($sizeEncode > 0 && $i < $sizeEncode) {
						$rowsEncode[$i][] = Formatters::seconds($metricResult->getTimeEncode()[$i]);
					}
					$sizeDecode = count($metricResult->getTimeDecode());
					if ($sizeDecode > 0 && $i < $sizeDecode) {
						$rowsDecode[$i][] = Formatters::seconds($metricResult->getTimeDecode()[$i]);
					}
				}
			}
		}

		$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);
		
		$rowsEncode[] = new TableSeparator();
		$rowsEncode[] = $meanEncode;
		$rowsEncode[] = new TableSeparator();
		$rowsEncode[] = $sizes;
		$nameEncode = 'Encode - ' . $time ;
		$this->printTable($nameEncode, $headersEncode, $rowsEncode);

		$rowsDecode[] = new TableSeparator();
		$rowsDecode[] = $meanDecode;
		$nameDecode = 'Decode - ' . $time ;
		$this->printTable($nameDecode, $headersDecode, $rowsDecode);
	}


	/**
	 * @param string $caption
	 * @param string[] $headers
	 * @param array $rows
	 */
	protected function printTable($caption, $headers, $rows) {

		$io = new SymfonyStyle($this->input, $this->output);
		$io->title($caption);
		$io->table($headers, $rows);
	}


}