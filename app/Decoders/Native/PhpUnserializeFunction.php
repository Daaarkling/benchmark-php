<?php

namespace Darkling\Benchmark\Decoders\Native;



use Darkling\Benchmark\IUnitBenchmark;

class PhpUnserializeFunction implements IUnitBenchmark
{

	public function execute($data)
	{
		unserialize($data);
	}
}