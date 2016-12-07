<?php

namespace Benchmark\Units\Msgpack;


use Benchmark\Units\AUnitBenchmark;

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