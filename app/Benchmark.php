<?php


namespace Benchmark;


use Benchmark\Converters\ArrayConverter;
use Benchmark\Units\IUnitBenchmark;
use Benchmark\Utils\ClassHelper;

abstract class Benchmark
{
	/** @var Config */
	protected $config;



	public function __construct(Config $config)
	{
		$this->config = $config;
	}


	/**
	 * Run benchmark
	 */
	public function run()
	{
		$result = [];
		$data = $this->prepareData();
		$dataFile = $this->config->getTestData();
		$repetitions = $this->config->getRepetitions();
		$mode = $this->config->getMode();

		foreach ($this->config->getConfigNode() as $formatName => $libs){
			foreach ($libs as $lib){

				$className = $lib->class;
				if (!($class = ClassHelper::instantiateClass($className, IUnitBenchmark::class))) {
					continue;
				}

				// run unit benchmark
				$unitResult = $class->run($data, $dataFile, $repetitions, $mode);

				// rearrange result
				$libName = property_exists($lib, 'version') ? $lib->name . ' ' . $lib->version : $lib->name;
				foreach ($unitResult as $type => $value) {
					foreach ($value['time'] as $time) {
						$result[$type][$libName]['time'][] = $time;
					}
					if (key_exists('size', $value)) {
						$result[$type][$libName]['size'] = $value['size'];
					}
					$result[$type][$libName]['format'] = $formatName;
				}
			}
		}

		$this->handleResult($result);
	}


	protected abstract function handleResult($result);



	protected function prepareData()
	{
		$arrayConverter = new ArrayConverter();
		$data = $arrayConverter->convertData(file_get_contents($this->config->getTestData()));
		return $data;
	}


	/**
	 * @return Config
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param Config $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
	}


}