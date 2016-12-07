<?php

namespace Benchmark\Unit\Msgpack;


use Benchmark\Unit\AUnitBenchmark;

class MsgpackOfficial extends AUnitBenchmark
{

	public function encode($data)
	{
		return msgpack_pack($data);
	}


	public function decode($data)
	{
		$data = msgpack_unpack($data);
	}
}