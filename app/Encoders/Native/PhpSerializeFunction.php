<?php

namespace Darkling\Benchmark\Encoders\Native;


use Darkling\Benchmark\IUnitBenchmark;

class PhpSerializeFunction implements IUnitBenchmark
{


	public function execute($data)
	{
		return serialize($data);
	}
}