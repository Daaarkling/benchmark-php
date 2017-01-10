<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 10. 1. 2017
 * Time: 14:53
 */

namespace Benchmark\Metrics;


class MetricResult
{
	/** @var string */
	private $name;

	/** @var int */
	private $size = 0;

	/** @var float[] */
	private $timeEncode = [];

	/** @var float[] */
	private $timeDecode = [];

	/**
	 * @return bool
	 */
	public function hasEncode() {

		return count($this->timeEncode) > 0;
	}


	/**
	 * @return bool
	 */
	public function hasDecode() {

		return count($this->timeDecode) > 0;
	}

	public function getMeanEncode() {

		return $this->computeMean($this->timeEncode);
	}


	public function getMeanDecode() {

		return $this->computeMean($this->timeDecode);
	}

	/**
	 * @param float[]|int[] $numbers
	 * @return float
	 */
	private function computeMean(array $numbers) {

		$count = count($numbers);
		if ($count == 0) {
			return 0;
		}

		$sum = 0;
		foreach ($numbers as $number) {
			$sum += $number;
		}
		return $sum / $count;
	}

	/**
	 * @param $time
	 */
	public function addTimeEncode($time) {

		$this->timeEncode[] = $time;
	}

	/**
	 * @param $time
	 */
	public function addTimeDecode($time) {

		$this->timeDecode[] = $time;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * @param int $size
	 */
	public function setSize($size)
	{
		$this->size = $size;
	}

	/**
	 * @return float[]
	 */
	public function getTimeEncode()
	{
		return $this->timeEncode;
	}

	/**
	 * @param \float[] $timeEncode
	 */
	public function setTimeEncode($timeEncode)
	{
		$this->timeEncode = $timeEncode;
	}

	/**
	 * @return float[]
	 */
	public function getTimeDecode()
	{
		return $this->timeDecode;
	}

	/**
	 * @param float[] $timeDecode
	 */
	public function setTimeDecode($timeDecode)
	{
		$this->timeDecode = $timeDecode;
	}


}