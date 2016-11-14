<?php

namespace Darkling\Benchmark;


interface IUnitBenchmark
{
	/**
	 * @param mixed $data
	 * @return string|void
	 */
	public function execute($data);
}