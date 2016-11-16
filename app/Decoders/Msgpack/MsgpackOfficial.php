<?php

namespace Darkling\Benchmark\Decoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;


class MsgpackOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$data = msgpack_unpack($data);
	}


}