<?php

namespace Benchmark\Decoders\Native;



use Benchmark\IUnitBenchmark;

class PhpUnserializeFunction implements IUnitBenchmark
{

	public function execute($data)
	{
		unserialize($data);
	}
}