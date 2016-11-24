<?php

namespace Benchmark\Encoders\Protobuf;


use Benchmark\IUnitBenchmark;

class GoogleProtobuf implements IUnitBenchmark
{

	public function execute($data)
	{
		return $data->encode();
	}
}