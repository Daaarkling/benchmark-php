<?php

namespace Benchmark\Units\Msgpack;


use Benchmark\Units\AUnitBenchmark;

require_once __DIR__ . '/../../../libs/onlinecity-msgpack-php/msgpack.php';

class OnlinecityMsgpack extends AUnitBenchmark
{

	public function encode($data)
	{
		return msgpack_pack_o($data);
	}

    public function decode($data)
    {
        $data = msgpack_unpack_o($data);
    }
}
