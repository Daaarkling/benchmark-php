<?php

namespace Benchmark\Encoders\Json;


use Benchmark\IUnitBenchmark;

class PhpJsonEncodeFunction implements IUnitBenchmark
{


	public function execute($data)
	{
		return json_encode($data);
	}
}