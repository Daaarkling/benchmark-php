<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmark;


class MsgpackOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$msg = msgpack_pack($data);
		return $msg;
	}


}