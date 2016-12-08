<?php

namespace Benchmark;

use DateTime;
use DateTimeZone;
use League\Csv\Writer;
use Nette\Utils\Strings;


class BenchmarkCsvOutput extends Benchmark
{

	/** @var string */
	public static $fileName = 'php-output';

	/** @var string */
	public static $timeFormat = 'Y-m-d-H-i-s';



	protected function handleResult($result)
	{
		foreach ($result as $typeName => $type) {

			$headersTable = [];
			$headers = [];
			$rows = [];

			// headers
			foreach ($type as $libName => $lib) {
				$headersTable[] = $lib['format'] . ' - ' . $libName;
				$headers[] = $libName;
			}


			// time
			for ($j = 0; $j < count($type[$headers[0]]['time']); $j++) {
				$row = [];
				foreach ($headers as $libName) {
					$row[] = $type[$libName]['time'][$j];
				}
				$rows[] = $row;
			}


			// sizes
			if (key_exists('size', $type[$headers[0]])) {
				$row = [];
				foreach ($headers as $libName) {
					$row[] = $type[$libName]['size'];
				}
				$rows[] = $row;
			}


			// create csv
			$time = (new DateTime('now', new DateTimeZone('Europe/Prague')))->format(self::$timeFormat);
			$fileName = __DIR__ . '/../output/' . self::$fileName . '-' . Strings::webalize($typeName) . '-' . $time . '.csv';

			$csv = Writer::createFromPath($fileName, 'w');
			$csv->setDelimiter(';');
			$csv->insertOne($headersTable);
			$csv->insertAll($rows);
		}
	}
}