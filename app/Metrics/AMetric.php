<?php

namespace Benchmark\Metrics;


use Benchmark\Config;

abstract class AMetric implements IMetric
{

	/** @var  mixed */
	protected $data;

	/** @var  string */
	protected $dataFile;


	/**
	 * @param mixed $data
	 * @param string $dataFile
	 * @param int $repetitions
	 * @param string $mode
	 * @return array
	 */
	public function run($data, $dataFile, $repetitions = 10, $mode = Config::MODE_OUTER)
	{
		$this->data = $data;
		$this->dataFile = $dataFile;

		if ($mode === Config::MODE_OUTER) {
			return $this->runOuter($repetitions);
		}
		return $this->runInner($repetitions);
	}

	/**
	 * @param int $repetitions
	 * @return array
	 */
	private function runInner($repetitions = 10)
	{
		$result = [];
		$this->prepareBenchmark();
		$data = $this->prepareDataForEncode();
		$output = NULL;

		// Do it once to warm up.
		$this->encode($data);

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

		// Do it once to warm up.
		$this->decode($encodedData);

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
	 * @param int $repetitions
	 * @return array
	 */
	private function runOuter($repetitions = 10)
	{
		$result = [];
		$this->prepareBenchmark();
		$data = $this->prepareDataForEncode();
		$output = NULL;

		// Do it once to warm up.
		$this->encode($data);

		$encoded = FALSE;
		$start = microtime(TRUE);
		for ($i = 1; $i <= $repetitions; $i++) {
			$output = $this->encode($data);
		}
		$time = microtime(TRUE) - $start;

		if ($output !== FALSE && !is_array($output)) {
			$result['encode']['time'][] = $time;
			$encoded = TRUE;
		}

		// size of string is always same (at least it should be), there is no need to repeat the process
		if ($encoded && (is_string($output) || is_array($output))) {
			$encodedData = is_array($output) ? $output['string'] : $output;
			$size = strlen($encodedData);
			$result['encode']['size'] = $size;
		} else {
			$encodedData = $this->prepareDataForDecode();
			if (!is_string($encodedData)) {
				return $result;
			}
		}


		// Do it once to warm up.
		$this->decode($encodedData);

		$output = NULL;
		$start = microtime(TRUE);
		for ($i = 1; $i <= $repetitions; $i++) {
			$output = $this->decode($encodedData);
		}
		$time = microtime(TRUE) - $start;
		if ($output !== FALSE && !is_float($output)) {
			$result['decode']['time'][] = $time;
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