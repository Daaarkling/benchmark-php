<?php


namespace Benchmark;



use Nette\Utils\Arrays;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Style\SymfonyStyle;

class BenchmarkTableOutput extends Benchmark
{

	/**@var SymfonyStyle */
	private $io;

	public function __construct(array $config, SymfonyStyle $io)
	{
		parent::__construct($config);
		$this->io = $io;
	}


	protected function handleResult($result)
	{

		foreach ($result as $typeName => $type) {

			$this->io->title($typeName);
			$summary['headers'] = [];
			$summary['rows'] = [];

			foreach ($type as $formatName => $libs) {

				// if there are no libs continue
				if (empty($libs)) {
					continue;
				}

				// print caption of table
				$this->io->section($formatName . ' (time)');

				// rearrange data to fit into Table (time)
				$headers = array_keys($libs);
				$rows = [];
				for ($j = 0; $j < count($libs[$headers[0]]['time']); $j++) {
					$row = [];
					foreach ($headers as $libName) {
						$row[] = $libs[$libName]['time'][$j];
					}
					$rows[] = $row;
				}

				// compute means
				$means = [];
				foreach ($headers as $libName) {
					$means[] = array_sum($libs[$libName]['time']) / count($libs[$libName]['time']);
				}
				$rows[] = new TableSeparator();
				$rows[] = $means;

				// print table
				$this->io->table($headers, $rows);

				Arrays::insertAfter($summary['headers'], -1, $headers);

				$summary['rows'][] = $means;
				var_dump($headers);


				// same for sizes
				if (key_exists('size', $libs[$headers[0]])) {
					$this->io->section($formatName . ' (size)');

					$headers = array_keys($libs);
					$rows = [];
					$row = [];
					foreach ($headers as $libName) {
						$row[] = $libs[$libName]['size'];
					}
					$rows[] = $row;
					$this->io->table($headers, $rows);
				}
			}

			var_dump($summary['headers']);

			// TODO
			$this->io->section($typeName . ' - summary');
			$this->io->table($summary['headers'], $summary['rows']);
		}
	}
}