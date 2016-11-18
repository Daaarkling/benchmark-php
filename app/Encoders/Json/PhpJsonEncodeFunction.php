<?php

namespace Darkling\Benchmark\Encoders\Json;


use Darkling\Benchmark\IUnitBenchmark;

class PhpJsonEncodeFunction implements IUnitBenchmark
{


	public function execute($data)
	{
		return json_encode($data);
	}
}