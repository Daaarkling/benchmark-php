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

			$headersTable = [];
			$headers = [];
			$means = [];
			$rows = [];

			// print title
			$io->title($typeName);


			// headers for table
			foreach ($type as $libName => $lib) {
				$headersTable[] = $lib['format'] . ' - ' . $libName;
				$headers[] = $libName;
			}


			// time
			for ($j = 0; $j < count($type[$headers[0]]['time']); $j++) {
				$row = [];
				foreach ($headers as $libName) {
					$row[] = Formatters::seconds($type[$libName]['time'][$j]);
				}
				$rows[] = $row;
			}


			// compute means
			foreach ($headers as $libName) {
				$means[] = Formatters::seconds(array_sum($type[$libName]['time']) / count($type[$libName]['time']));
			}
			// only if there is more then two rows
			if ($means !== $row) {
				$rows[] = new TableSeparator();
				$rows[] = $means;
			}



			// sizes
			if (key_exists('size', $type[$headers[0]])) {
				$row = [];
				foreach ($headers as $libName) {
					$row[] = Formatters::bytes($type[$libName]['size']);
				}
				$rows[] = new TableSeparator();
				$rows[] = $row;
			}

			// print table
			$io->table($headersTable, $rows);
		}
	}
}