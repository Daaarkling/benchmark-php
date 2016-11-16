<?php

namespace Darkling\Benchmark\Encoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use Sabre\Xml\Service;


class MsgpackOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$msg = msgpack_pack($data);
		return $msg;
	}


}