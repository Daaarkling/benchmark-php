<?php

namespace Benchmark\Units;


interface IUnitBenchmark
{
	const METHOD_OUTER = 0;
	const METHOD_INNER = 1;


	/**
	 * Method for run the benchmark, should execute encode() and decode() methods and deliver result
	 *
	 * @param mixed $data
	 * @param string $dataFile
	 * @param int $repetitions
	 * @param int $method
	 * @return array
	 */
	public function run($data, $dataFile, $repetitions = 10, $method = self::METHOD_INNER);


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