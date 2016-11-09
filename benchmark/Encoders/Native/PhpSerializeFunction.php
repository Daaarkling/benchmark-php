<?php

namespace Benchmark\Encoders\Native;


use Benchmark\IUnitBenchmarkTest;

class PhpSerializeFunction implements IUnitBenchmarkTest
{


	public function execute($data)
	{
		return serialize($data);
	}
}