<?php

namespace Benchmark\Metrics\Msgpack;


use Benchmark\Metrics\AMetric;
use MessagePack\BufferUnpacker;
use MessagePack\Packer;


class RybakitMsgpack extends AMetric
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
