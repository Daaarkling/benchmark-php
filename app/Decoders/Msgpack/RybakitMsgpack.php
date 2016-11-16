<?php

namespace Darkling\Benchmark\Decoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use MessagePack\Unpacker;


class RybakitMsgpack implements IUnitBenchmark
{


	public function execute($data)
	{
		$unpacked = (new Unpacker())->unpack($data);
	}


}