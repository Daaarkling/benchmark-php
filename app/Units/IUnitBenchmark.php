<?php

namespace Benchmark\Units;


use Benchmark\Config;

interface IUnitBenchmark
{
	/**
	 * Method for run the benchmark, should execute encode() and decode() methods and deliver result
	 *
	 * @param mixed $data
	 * @param string $dataFile
	 * @param int $repetitions
	 * @param string $mode
	 * @return array
	 */
	public function run($data, $dataFile, $repetitions = Config::REPETITIONS_DEFAULT, $mode = Config::MODE_INNER);


	/**
	 * Method returns string if everything went well (result may be used for decode) or
	 * FALSE if encode is not implemented or
	 * ARRAY if measurement is inside the method (array should contain string and time)
	 *
	 *
	 * @param mixed $data
	 * @return string|float|FALSE
	 */
	public function encode($data);


	/**
	 * Method returns VOID if everything went well or
	 * FALSE if decode is not implemented or
	 * FLOAT if measurement is inside the method
	 *
	 *
	 * @param mixed $data
	 * @return void|float|FALSE
	 */
	public function decode($data);
}