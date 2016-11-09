<?php


namespace Benchmark;



class Benchmark
{
	/** @var array */
	private $config;

	/** @var string */
	private $testData;


	public function __construct(array $config)
	{
		$this->config = $config;
		$this->testData = file_get_contents(__DIR__ . '/../config/' . $config['testData']);
	}


	public function run()
	{
		$result = [];
		$repetitions = $this->config['repetitions'];

		foreach ($this->config['tests'] as $typeName => $type){

			$converterName = $type['converter'];
			if (!($dataConverter = $this->instantiateClass($converterName, IDataConverter::class))) {
				continue;
			}
			$data = $dataConverter->convertData($this->testData);

			foreach ($type['formats'] as $formatName => $format){
				foreach ($format as $lib){

					$className = $lib['class'];
					if (!($class = $this->instantiateClass($className, IUnitBenchmarkTest::class))) {
						continue;
					}

					if (key_exists('converter', $lib) && $lib['converter']) {
						$converterName = $lib['converter'];
						if (!($dataConverter = $this->instantiateClass($converterName, IDataConverter::class))) {
							continue;
						}
						$data = $dataConverter->convertData($this->testData);
					}

					for ($i = 1; $i <= $repetitions; $i++) {

						$start = microtime(TRUE);
						$string = $class->execute($data);
						$time = microtime(TRUE) - $start;

						$result[$typeName][$formatName][$lib['name']]['time'][] = $time;

						if ($string) {
							$size = strlen($string);
							$result[$typeName][$formatName][$lib['name']]['size'][] = $size;
						}
					}
				}

			}
		}
		$this->handleResult($result);
	}


	protected function handleResult($result)
	{
		var_dump($result);
		exit;
	}


	/**
	 * @param string $className
	 * @param string $instanceof
	 * @return IUnitBenchmarkTest|IDataConverter|NULL object
	 */
	protected function instantiateClass($className, $instanceof)
	{
		if (!class_exists($className)) {
			return NULL;
		}
		$class = new $className();
		if (!$class instanceof $instanceof) {
			return NULL;
		}
		return $class;
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
	public function setTestData(string $testData)
	{
		$this->testData = $testData;
	}



}