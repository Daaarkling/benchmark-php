<?php

namespace Benchmark\Encoders\Native;


use Benchmark\IUnitBenchmark;

class PhpSerializeFunction implements IUnitBenchmark
{


	public function execute($data)
	{
		return serialize($data);
	}
}