<?php

namespace Benchmark;

use DateTime;
use DateTimeZone;
use League\Csv\Writer;


class BenchmarkCsvOutput extends Benchmark
{

	/** @var string */
	public static $fileName = 'php-output';

	/** @var string */
	public static $timeFormat = 'Y-m-d-H-i-s';

	/** @var string */
	private $outputDir;


	public function __construct(Config $config, $outputDir)
	{
		parent::__construct($config);
		$this->outputDir = $outputDir;
	}


	protected function handleResult($result)
	{
		$headersEncode = [];
		$headersDecode = [];
		$rowsEncode = [];
		$rowsDecode = [];
		$sizes = [];

		$count = $this->config->getRepetitions();
		for ($i = 0; $i < $count; $i++) {
			foreach ($result as $typeName => $libs) {
				foreach ($libs as $metricResult) {
					if ($i === 0) {
						if ($metricResult->hasEncode()) {
							$headersEncode[] = $typeName . " - " . $metricResult->getName();
							$sizes[] = $metricResult->getSize();
						}
						if ($metricResult->hasDecode()) {
							$headersDecode[] = $typeName . " - " . $metricResult->getName();
						}
					}
					$sizeEncode = count($metricResult->getTimeEncode());
					if ($sizeEncode > 0 && $i < $sizeEncode) {
						$rowsEncode[$i][] = $metricResult->getTimeEncode()[$i];
					}
					$sizeDecode = count($metricResult->getTimeDecode());
					if ($sizeDecode > 0 && $i < $sizeDecode) {
						$rowsDecode[$i][] = $metricResult->getTimeDecode()[$i];
					}
				}
			}
		}

		$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);

		$fileNameEncode = $this->outputDir . '/' . self::$fileName . '-encode-' . $time . '.csv';
		$rowsEncode[] = $sizes;
		$this->writeCsv($fileNameEncode, $headersEncode, $rowsEncode);

		$fileNameDecode = $this->outputDir . '/' . self::$fileName . '-decode-' . $time . '.csv';
		$this->writeCsv($fileNameDecode, $headersDecode, $rowsDecode);
	}


	/**
	 * @param string $name
	 * @param string[] $headers
	 * @param array $rows
	 */
	protected function writeCsv($name, $headers, $rows) {

		$csv = Writer::createFromPath($name, 'w');
		$csv->setDelimiter(';');
		$csv->insertOne($headers);
		$csv->insertAll($rows);
	}
}