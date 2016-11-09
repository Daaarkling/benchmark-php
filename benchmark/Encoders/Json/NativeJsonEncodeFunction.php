<?php

namespace Benchmark\Encoders\Json;


use Benchmark\IUnitBenchmarkTest;

class NativeJsonEncodeFunction implements IUnitBenchmarkTest
{


	public function execute($data)
	{
		return json_encode($data);
	}
}