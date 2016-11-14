<?php

namespace Darkling\Benchmark\Decoders\Native;


use Benchmark\IUnitBenchmarkTest;

class PhpUnserializeFunction implements IUnitBenchmarkTest
{


	public function execute($data)
	{
		return unserialize($data);
	}
}