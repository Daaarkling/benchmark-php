<?php

namespace Benchmark\Units;


interface IUnitBenchmark
{
	/**
	 * @param mixed $data
	 * @param int $repetitions
	 * @return array
	 */
	public function run($data, $repetitions = 10);


	/**
	 * @param mixed $data
	 * @return string|FALSE
	 */
	public function encode($data);


	/**
	 * @param mixed $data
	 * @return string|FALSE
	 */
	public function decode($data);
}