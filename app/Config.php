<?php


namespace Benchmark;


class Config
{
	const MODE_OUTER = 'outer';
	const MODE_INNER = 'inner';
	const MODES = [Config::MODE_INNER, Config::MODE_OUTER];

	const REPETITIONS_DEFAULT = 10;

	/** @var string */
	public static $configFile = __DIR__ . '/../config/config.json';

	/** @var string */
	public static $schemaFile = __DIR__ . '/../config/schema.json';

	/** @var string */
	public static $testDataFile = __DIR__ . '/../config/testdata.json';

	/** @var  array */
	private $configNode;

	/** @var  string */
	private $testData;

	/** @var int */
	private $repetitions = 10;

	/** @var string */
	private $mode = self::MODE_INNER;

	/**
	 * Config constructor.
	 * @param mixed $configNode
	 * @param string $testData
	 * @param int $repetitions
	 * @param string $mode
	 */
	public function __construct($configNode, $testData, $repetitions = self::REPETITIONS_DEFAULT, $mode = self::MODE_INNER)
	{
		$this->configNode = $configNode;
		$this->testData = $testData;
		$this->repetitions = $repetitions;
		$this->mode = $mode;
	}

	/**
	 * @return mixed
	 */
	public function getConfigNode()
	{
		return $this->configNode;
	}

	/**
	 * @param mixed $configNode
	 */
	public function setConfigNode($configNode)
	{
		$this->configNode = $configNode;
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

	/**
	 * @return int
	 */
	public function getRepetitions()
	{
		return $this->repetitions;
	}

	/**
	 * @param int $repetitions
	 */
	public function setRepetitions($repetitions)
	{
		if ($repetitions >= 1) {
			$this->repetitions = $repetitions;
		} else {
			$this->repetitions = self::REPETITIONS_DEFAULT;
		}
	}

	/**
	 * @return string
	 */
	public function getMode()
	{
		return $this->mode;
	}

	/**
	 * @param string $mode
	 */
	public function setMode($mode)
	{
		if ($mode == self::MODE_OUTER) {
			$this->mode = self::MODE_OUTER;
		} else {
			$this->mode = self::MODE_INNER;
		}
	}





}