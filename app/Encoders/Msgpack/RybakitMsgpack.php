<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmark;
use MessagePack\Packer;


class RybakitMsgpack implements IUnitBenchmark
{
    private $packer;

    public function __construct()
    {
        $this->packer = new Packer(Packer::FORCE_STR | Packer::FORCE_MAP);
    }

    public function execute($data)
    {
        return $this->packer->pack($data);
    }
}
