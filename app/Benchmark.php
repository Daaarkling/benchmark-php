<?php


namespace Benchmark;


use Benchmark\Converters\ArrayConverter;
use Benchmark\Metrics\IMetric;
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
				if (!($class = ClassHelper::instantiateClass($className, IMetric::class))) {
					continue;
				}

				// run unit benchmark
				$metricResult = $class->run($data, $dataFile, $repetitions, $mode);

				if($metricResult === NULL){
					continue;
				}

				$name = property_exists($lib, 'version') ? $lib->name . ' ' . $lib->version : $lib->name;
				$metricResult->setName($name);

				$result[$formatName][] = $metricResult;
			}
		}
		$this->handleResult($result);
	}


	protected abstract function handleResult($result);


	/**
	 * @return mixed
	 */
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