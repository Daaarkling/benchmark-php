<?php


namespace Darkling\Benchmark;



use League\Csv\Writer;
use Nette\Utils\Strings;
use SplTempFileObject;

class BenchmarkCsvOutput extends Benchmark
{

	protected function handleResult($result)
	{
		foreach ($result as $typeName => $type) {

			$summary['headers'] = [];
			$summary['means'] = [];
			$summary['sizes'] = [];

			foreach ($type as $formatName => $libs) {

				// if there are no libs continue
				if (empty($libs)) {
					continue;
				}

				// rearrange data
				$headers = array_keys($libs);
				$rows = [];
				for ($j = 0; $j < count($libs[$headers[0]]['time']); $j++) {
					$row = [];
					foreach ($headers as $libName) {
						$row[] = $libs[$libName]['time'][$j];
					}
					$rows[] = $row;
				}

				// create csv
				$fileName = __DIR__ . '/../output/' . Strings::webalize($typeName . '-' . $formatName . '-time') . '.csv';
				$this->writeCsv($fileName, $headers, $rows);


				// compute means
				$means = [];
				foreach ($headers as $libName) {
					$means[] = $mean = array_sum($libs[$libName]['time']) / count($libs[$libName]['time']);
					$summary['means'][] = $mean;
					$summary['headers'][] = $libName;
				}


				// same for sizes
				if (key_exists('size', $libs[$headers[0]])) {
					$headers = array_keys($libs);
					$rows = [];
					$row = [];
					foreach ($headers as $libName) {
						$row[] = $size = $libs[$libName]['size'];
						$summary['sizes'][] = $size;
					}
					$rows[] = $row;

					// create csv
					$fileName = __DIR__ . '/../output/' . Strings::webalize($typeName . '-' . $formatName . '-size') . '.csv';
					$this->writeCsv($fileName, $headers, $rows);
				}
			}

			// summary
			$rows = [];
			if (empty($summary['sizes'])) {
				$rows[] = $summary['means'];
			} else{
				$rows[] = $summary['means'];
				$rows[] = $summary['sizes'];
			}

			// create csv
			$fileName = __DIR__ . '/../output/' . Strings::webalize($typeName . '-summary') . '.csv';
			$this->writeCsv($fileName, $summary['headers'], $rows);
		}
	}


	private function writeCsv($fileName, $headers, $rows)
	{
		$csv = Writer::createFromPath($fileName, 'w');
		$csv->setDelimiter(';');
		$csv->insertOne($headers);
		$csv->insertAll($rows);
	}
}