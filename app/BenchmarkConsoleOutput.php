<?php


namespace Benchmark;


use Benchmark\Utils\Formatters;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BenchmarkConsoleOutput extends Benchmark
{
	
	/** @var InputInterface */
	protected $input;

	/** @var OutputInterface */
	protected $output;

	
	
	public function __construct(array $config, InputInterface $input, OutputInterface $output)
	{
		parent::__construct($config);
		
		$this->input = $input;
		$this->output = $output;
	}


	protected function handleResult($result)
	{
		$io = new SymfonyStyle($this->input, $this->output);


		foreach ($result as $typeName => $type) {

			$io->title($typeName);

			$summary['headers'] = [];
			$summary['means'] = [];
			$summary['sizes'] = [];

			foreach ($type as $formatName => $libs) {

				// if there are no libs continue
				if (empty($libs)) {
					continue;
				}

				// print caption of table
				$io->section($formatName . ' (time)');

				// rearrange data to fit into Table (time)
				$headers = array_keys($libs);
				$rows = [];
				for ($j = 0; $j < count($libs[$headers[0]]['time']); $j++) {
					$row = [];
					foreach ($headers as $libName) {
						$row[] = Formatters::seconds($libs[$libName]['time'][$j]);
					}
					$rows[] = $row;
				}

				// compute means
				$means = [];
				foreach ($headers as $libName) {
					$means[] = $mean = Formatters::seconds(array_sum($libs[$libName]['time']) / count($libs[$libName]['time']));
					$summary['means'][] = $mean;
					$summary['headers'][] = $libName;
				}
				$rows[] = new TableSeparator();
				$rows[] = $means;

				// print table
				$io->table($headers, $rows);


				// same for sizes
				if (key_exists('size', $libs[$headers[0]])) {
					$io->section($formatName . ' (size)');

					$headers = array_keys($libs);
					$rows = [];
					$row = [];
					foreach ($headers as $libName) {
						$row[] = $size = Formatters::bytes($libs[$libName]['size']);
						$summary['sizes'][] = $size;
					}
					$rows[] = $row;
					$io->table($headers, $rows);
				}
			}

			// summary
			$io->section($typeName . ' - summary');

			$rows = [];
			if (empty($summary['sizes'])) {
				$rows[] = $summary['means'];
			} else{
				$rows[] = $summary['means'];
				$rows[] = new TableSeparator();
				$rows[] = $summary['sizes'];
			}

			$io->table($summary['headers'], $rows);
		}
	}
}