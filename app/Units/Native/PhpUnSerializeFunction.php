<?php

namespace Benchmark\Units\Native;



use Benchmark\Units\AUnitBenchmark;

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