<?php

namespace Benchmark;


interface IUnitBenchmark
{
	/**
	 * @param mixed $data
	 * @return string|void
	 */
	public function execute($data);
}