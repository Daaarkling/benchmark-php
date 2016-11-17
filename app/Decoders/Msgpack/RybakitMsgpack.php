<?php

namespace Darkling\Benchmark\Decoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use MessagePack\BufferUnpacker;


class RybakitMsgpack implements IUnitBenchmark
{
    private $bufferUnpacker;

    public function __construct()
    {
        $this->bufferUnpacker = new BufferUnpacker();
    }

    public function execute($data)
    {
        $unpacked = $this->bufferUnpacker->reset($data)->unpack();
    }
}
