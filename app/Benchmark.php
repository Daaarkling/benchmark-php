<?php


namespace Benchmark;


use Benchmark\Converters\ArrayConverter;
use Benchmark\Unit\IUnitBenchmark;
use Benchmark\Utils\ClassHelper;

abstract class Benchmark
{
	/** @var array */
	protected $config;

	/** @var string */
	protected $testData;


	public function __construct(array $config)
	{
		$this->config = $config;
		$this->testData = file_get_contents($config['testData']);
	}


	/**
	 * Run benchmark
	 */
	public function run()
	{
		$result = [];
		$arrayConverter = new ArrayConverter();
		$data = $arrayConverter->convertData($this->testData);
		$repetitions = $this->config['repetitions'];

		foreach ($this->config['benchmark'] as $formatName => $libs){
			foreach ($libs as $lib){

				$className = $lib['class'];
				if (!($class = ClassHelper::instantiateClass($className, IUnitBenchmark::class))) {
					continue;
				}

				// run unit benchmark
				$unitResult = $class->run($data, $repetitions);

				//
				$libName = key_exists('version', $lib) ? $lib['name'] . ' ' . $lib['version'] : $lib['name'];
				foreach ($unitResult as $type => $value) {
					foreach ($value['time'] as $time) {
						$result[$type][$formatName][$libName]['time'][] = $time;
					}
					if (key_exists('size', $value)) {
						$result[$type][$formatName][$libName]['size'] = $value['size'];
					}
				}
			}
		}

		$this->handleResult($result);
	}


	protected abstract function handleResult($result);




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