<?php

namespace Benchmark\Unit\Native;



use Benchmark\Unit\AUnitBenchmark;

class PhpUnSerializeFunction extends AUnitBenchmark
{

	public function encode($data)
	{
		return serialize($data);
	}

	public function decode($data)
	{
		unserialize($data);
	}
}