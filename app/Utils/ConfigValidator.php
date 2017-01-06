<?php


namespace Benchmark\Utils;

use Benchmark\Config;
use Benchmark\Units\IUnitBenchmark;
use JsonSchema\Validator as JValidator;
use Nette\Utils\Json;



class ConfigValidator
{
	/** @var array */
	private $errors = [];

	/** @var Config */
	private $config;

	/** @var  JValidator */
	private $schemaValidator;



	public function __construct(Config $config)
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
		if($this->isValid()) {
			$this->validateRepetitions();
			$this->validateMode();
			$this->validateClasses();
			$this->validateTestData();
		}
	}


	/**
	 * Validate given config against the schema
	 */
	public function validateConfig()
	{
		$schemaContent = @file_get_contents(Config::$schemaFile);
		if($schemaContent === FALSE) {
			$this->errors['File not found'][] = [
				'property' => Config::$schemaFile,
				'message' => 'Schema file not found.'
			];
			return;
		}

		$schema = Json::decode($schemaContent);

		$this->schemaValidator->check($this->config, $schema);

		if (!$this->schemaValidator->isValid()) {
			$this->errors['schema'] = $this->schemaValidator->getErrors();
		}
	}



	public function validateRepetitions() {

		$repetitions = $this->config->getRepetitions();
		if (!is_numeric($repetitions) || $repetitions < 1){
			$this->errors['repetitions'][] = [
				'property' => 'repetitions',
				'message' => 'Repetitions must be whole number greater than one.'
			];
		}
	}


	public function validateMode() {

		$mode = $this->config->getMode();
		if (!in_array($mode, Config::MODES)){
			$this->errors['mode'][] = [
				'property' => 'mode',
				'message' => 'Method must be one of these options: ' . implode(', ', Config::MODES)
			];
		}
	}



	/**
	 * Check existence of classes and converters
	 */
	public function validateClasses()
	{
		foreach ($this->config->getConfigNode() as $libs) {
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
		$testDataFileName = $this->config->getTestData();
		if (!(realpath($testDataFileName) || realpath(Config::$testDataFile))){
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
		$this->errors = [];
	}



}