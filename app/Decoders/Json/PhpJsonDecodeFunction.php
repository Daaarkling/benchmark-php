<?php

namespace Darkling\Benchmark\Decoders\Json;


use Darkling\Benchmark\IUnitBenchmark;



class PhpJsonDecodeFunction implements IUnitBenchmark
{

	public function execute($data)
	{
		json_decode($data);
	}
}