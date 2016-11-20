<?php

namespace Benchmark\Decoders\Xml;


use Benchmark\IUnitBenchmark;


class MsgpackOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$data = msgpack_unpack($data);
	}


}