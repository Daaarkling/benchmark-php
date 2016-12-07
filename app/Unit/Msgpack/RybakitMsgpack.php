<?php

namespace Benchmark\Unit\Msgpack;


use Benchmark\Unit\AUnitBenchmark;
use MessagePack\BufferUnpacker;
use MessagePack\Packer;


class RybakitMsgpack extends AUnitBenchmark
{
	/** @var BufferUnpacker */
    private $bufferUnpacker;

	/** @var  Packer */
	private $packer;


	public function prepareBenchmark()
	{
		$this->bufferUnpacker = new BufferUnpacker();
		$this->packer = new Packer(Packer::FORCE_STR | Packer::FORCE_MAP);
	}


	public function encode($data)
	{
		return $this->packer->pack($data);
	}


    public function decode($data)
    {
        $unpacked = $this->bufferUnpacker->reset($data)->unpack();
    }
}
