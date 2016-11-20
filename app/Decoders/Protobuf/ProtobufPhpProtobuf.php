<?php

namespace Benchmark\Decoders\Protobuf;


use Benchmark\Converters\ProtobufPhpProtobuf\RestaurantCollection;
use Benchmark\IUnitBenchmark;

class ProtobufPhpProtobuf implements IUnitBenchmark
{

	public function execute($data)
	{
		$restaurants = new RestaurantCollection($data);
	}
}