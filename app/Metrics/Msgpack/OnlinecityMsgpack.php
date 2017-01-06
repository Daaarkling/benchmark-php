<?php

namespace Benchmark\Metrics\Msgpack;


use Benchmark\Metrics\AMetric;

require_once __DIR__ . '/../../../libs/onlinecity-msgpack-php/msgpack.php';

class OnlinecityMsgpack extends AMetric
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
