<?php

namespace Benchmark\Metrics\Msgpack;


use Benchmark\Metrics\AMetric;

class MsgpackOfficial extends AMetric
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