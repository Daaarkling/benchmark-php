<?php

namespace Benchmark\Encoders\Protobuf;


use Benchmark\IUnitBenchmark;

class ProtobufPhpProtobuf implements IUnitBenchmark
{

	public function execute($data)
	{

		$stream = $data->toStream();
		return $stream;
	}
}