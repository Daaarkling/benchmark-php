<?php

namespace Benchmark\Units;


use InvalidArgumentException;

abstract class AUnitBenchmark implements IUnitBenchmark
{
	/** @var  mixed */
	protected $data;



	/**
	 * @param mixed $data
	 * @param int $repetitions
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function run($data, $repetitions = 10)
	{
		if ($repetitions < 1) {
			throw new InvalidArgumentException('Number of repetitions must be greater then 0.');
		}

		$result = [];
		$this->data = $data;
		$encodedData = FALSE;
		$this->prepareBenchmark();
		$data = $this->prepareDataForEncode();

		for ($i = 1; $i <= $repetitions; $i++) {
			$start = microtime(TRUE);
			$encodedData = $this->encode($data);
			$time = microtime(TRUE) - $start;

			if ($encodedData === FALSE) {
				break;
			}
			$result['encode']['time'][] = $time;
		}

		// size of string is always same (at least it should be), there is no need to repeat the process
		if (is_string($encodedData)) {
			$size = strlen($encodedData);
			$result['encode']['size'] = $size;
		} else {
			$encodedData = $this->prepareDataForDecode();
			if (!is_string($encodedData)) {
				return $result;
			}
		}

		for ($i = 1; $i <= $repetitions; $i++) {
			$start = microtime(TRUE);
			$output = $this->decode($encodedData);
			$time = microtime(TRUE) - $start;

			if ($output === FALSE) {
				break;
			}
			$result['decode']['time'][] = $time;
		}

		return $result;
	}


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