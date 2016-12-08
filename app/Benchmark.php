<?php


namespace Benchmark;


use Benchmark\Converters\ArrayConverter;
use Benchmark\Units\IUnitBenchmark;
use Benchmark\Utils\ClassHelper;

abstract class Benchmark
{
	/** @var array */
	protected $config;



	public function __construct(array $config)
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
		$dataFile = $this->config['testData'];
		$repetitions = $this->config['repetitions'];

		foreach ($this->config['benchmark'] as $formatName => $libs){
			foreach ($libs as $lib){

				$className = $lib['class'];
				if (!($class = ClassHelper::instantiateClass($className, IUnitBenchmark::class))) {
					continue;
				}

				// run unit benchmark
				$unitResult = $class->run($data, $dataFile, $repetitions);

				// rearrange result
				$libName = key_exists('version', $lib) ? $lib['name'] . ' ' . $lib['version'] : $lib['name'];
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
		$data = $arrayConverter->convertData(file_get_contents($this->config['testData']));
		return $data;
	}


	/**
	 * @return array
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param array $config
	 */
	public function setConfig(array $config)
	{
		$this->config = $config;
	}

	/**
	 * @return string
	 */
	public function getTestData()
	{
		return $this->testData;
	}

	/**
	 * @param string $testData
	 */
	public function setTestData($testData)
	{
		$this->testData = $testData;
	}



}