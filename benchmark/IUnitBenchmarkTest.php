<?php

namespace Benchmark;


interface IUnitBenchmarkTest
{
	/**
	 * @param array $data
	 * @return string
	 */
	public function execute($data);
}