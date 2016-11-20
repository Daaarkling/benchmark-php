<?php

namespace Benchmark\Decoders\Json;


use Benchmark\IUnitBenchmark;



class PhpJsonDecodeFunction implements IUnitBenchmark
{

	public function execute($data)
	{
		json_decode($data);
	}
}