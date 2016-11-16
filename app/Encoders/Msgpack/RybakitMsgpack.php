<?php

namespace Darkling\Benchmark\Encoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use MessagePack\Packer;
use MessagePack\Unpacker;


class RybakitMsgpack implements IUnitBenchmark
{


	public function execute($data)
	{
		$packer = new Packer();
		$packer->setTypeDetectionMode(Packer::FORCE_STR | Packer::FORCE_MAP);
		$packed = $packer->pack($data);
		return $packed;
	}


}