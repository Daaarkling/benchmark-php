<?php


namespace Benchmark\Utils;

use Benchmark\Converters\IDataConverter;
use Benchmark\Unit\IUnitBenchmark;
use JsonSchema\Validator as JValidator;
use Nette\Utils\Json;



class Validator
{
	/** @var string */
	public static $configFile = __DIR__ . '/../../config/config.json';

	/** @var string */
	public static $schemaFile = __DIR__ . '/../../config/schema.json';

	/** @var string */
	public static $testDataFile = __DIR__ . '/../../config/testdata.json';

	/** @var array */
	private $errors = [];

	/** @var object */
	private $config;

	/** @var  JValidator */
	private $schemaValidator;



	public function __construct($config)
	{
		$this->setConfig($config);
		$this->schemaValidator = new JValidator();
	}

	/**
	 * Validate given config against the schema,
	 * check existence of classes and converters,
	 * check existence of test data
	 */
	public function validate()
	{
		$this->errors = [];

		$this->validateConfig();

		// there is no point to continue if config is not valid against the schema
		if (!$this->hasErrors()) {
			$this->validateClasses();
			$this->validateTestData();
		}
	}


	/**
	 * Validate given config against the schema
	 */
	public function validateConfig()
	{
		$schema = Json::decode(file_get_contents(self::$schemaFile));

		$this->schemaValidator->check($this->config, $schema);

		if (!$this->schemaValidator->isValid()) {
			$this->errors['schema'] = $this->schemaValidator->getErrors();
		}
	}


	/**
	 * Check existence of classes and converters
	 */
	public function validateClasses()
	{
		foreach ($this->config->benchmark as $libs) {
			foreach ($libs as $lib) {
				if (!$this->isClassValid($lib->class, IUnitBenchmark::class)) {
					$this->addClassError($lib->class);
				}
			}
		}
	}

	/**
	 * @param string $class
	 * @param string $type
	 * @return bool
	 */
	public function isClassValid($class, $type)
	{
		$object = ClassHelper::instantiateClass($class, $type);
		return $object !== NULL;
	}

	/**
	 * @param string $property
	 */
	private function addClassError($property)
	{
		$this->errors['classes'][] = [
				'property' => $property,
				'message' => 'Class not found or is not instantiable.'
			];
	}


	/**
	 * Check existence of test data
	 */
	public function validateTestData()
	{
		$testDataFileName = $this->config->testData;
		if (!(realpath($testDataFileName) || realpath(self::$testDataFile))){
			$this->errors['testData'][] = [
				'property' => 'testData',
				'message' => 'Test data file was not found.'
			];
		}
	}


	/**
	 * @return bool
	 */
	public function isValid()
	{
		return !$this->hasErrors();
	}

	/**
	 * @return bool
	 */
	public function hasErrors()
	{
		return !empty($this->errors);
	}


	/**
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}


	/**
	 * @return object
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * @param object $config
	 */
	public function setConfig($config)
	{
		$this->config = $config;
		$this->errors = [];
	}



}