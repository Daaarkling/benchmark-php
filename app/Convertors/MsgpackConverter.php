<?php


namespace Benchmark\Converters;

use Nette\Utils\Json;

class MsgpackConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		$array = Json::decode($jsonTestData, Json::FORCE_ARRAY);
		return msgpack_pack($array);
	}


}