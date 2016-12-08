<?php

namespace Benchmark\Units;


use InvalidArgumentException;

abstract class AUnitBenchmark implements IUnitBenchmark
{
	/** @var  mixed */
	protected $data;

	/** @var  string */
	protected $dataFile;



	/**
	 * @param mixed $data
	 * @param string $dataFile
	 * @param int $repetitions
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function run($data, $dataFile, $repetitions = 10)
	{
		if ($repetitions < 1) {
			throw new InvalidArgumentException('Number of repetitions must be greater then 0.');
		}

		$result = [];
		$this->data = $data;
		$this->dataFile = $dataFile;
		$this->prepareBenchmark();
		$data = $this->prepareDataForEncode();
		$output = NULL;

		for ($i = 1; $i <= $repetitions; $i++) {
			$start = microtime(TRUE);
			$output = $this->encode($data);
			$time = microtime(TRUE) - $start;

			if ($output === FALSE) {
				break;
			}
			$result['encode']['time'][] = is_array($output) ? $output['time'] : $time;
		}

		// size of string is always same (at least it should be), there is no need to repeat the process
		if (is_string($output) || is_array($output)) {
			$encodedData = is_array($output) ? $output['string'] : $output;
			$size = strlen($encodedData);
			$result['encode']['size'] = $size;
		} else {
			$encodedData = $this->prepareDataForDecode();
			if (!is_string($encodedData)) {
				return $result;
			}
		}

		$output = NULL;
		for ($i = 1; $i <= $repetitions; $i++) {
			$start = microtime(TRUE);
			$output = $this->decode($encodedData);
			$time = microtime(TRUE) - $start;

			if ($output === FALSE) {
				break;
			}
			$result['decode']['time'][] = is_float($output) ? $output : $time;
		}

		return $result;
	}


	/**
	 * Its called once before encode()
	 */
	protected function prepareBenchmark()
	{

	}


	/**
	 * @return mixed
	 */
	protected function prepareDataForEncode()
	{
		return $this->data;
	}


	/**
	 * If encode returns void this method must return string, otherwise decode() wont proceed
	 *
	 * @return mixed
	 */
	protected function prepareDataForDecode()
	{
	}


	/**
	 * @param mixed $data
	 * @return string|FALSE
	 */
	public function encode($data)
	{
		return FALSE;
	}


	/**
	 * @param mixed $data
	 * @return string|FALSE
	 */
	public function decode($data)
	{
		return FALSE;
	}

}