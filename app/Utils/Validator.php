<?php


namespace Darkling\Benchmark\Utils;

use Darkling\Benchmark\Converters\IDataConverter;
use Darkling\Benchmark\IUnitBenchmark;
use JsonSchema\Validator as JValidator;
use Nette\Utils\Json;



class Validator
{
	/** @var string */
	public static $schema = 'schema.json';

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
		$schema = Json::decode(file_get_contents(__DIR__ . '/../../config/' . self::$schema));

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
		foreach ($this->config->benchmark as $type) {

			if (property_exists($type, 'converter')) {
				if (!$this->isClassValid($type->converter, IDataConverter::class)) {
					$this->addClassError($type->converter);
				}
			}

			foreach ($type->formats as $format) {

				if (property_exists($format, 'converter')) {
					if (!$this->isClassValid($format->converter, IDataConverter::class)) {
						$this->addClassError($format->converter);
					}
				}

				foreach ($format->libs as $lib) {
					if (!$this->isClassValid($lib->class, IUnitBenchmark::class)) {
						$this->addClassError($lib->class);
					}
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
		$object = ClassInstantiator::instantiateClass($class, $type);
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
		$testDataFile = __DIR__ . '/../../config/' . $this->config->testData;
		if (!file_exists($testDataFile)) {
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