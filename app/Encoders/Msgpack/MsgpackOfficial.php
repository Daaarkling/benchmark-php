<?php

namespace Benchmark\Encoders\Msgpack;


use Benchmark\IUnitBenchmark;


class MsgpackOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$msg = msgpack_pack($data);
		return $msg;
	}


}