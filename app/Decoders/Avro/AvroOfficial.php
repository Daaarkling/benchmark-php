<?php

namespace Benchmark\Decoders\Avro;


use AvroDataIOReader;
use AvroIODatumReader;
use AvroStringIO;
use Benchmark\IUnitBenchmark;


class AvroOfficial implements IUnitBenchmark
{


	public function execute($data)
	{
		$readIO = new AvroStringIO($data);
		$dataReader = new AvroDataIOReader($readIO, new AvroIODatumReader());
		$data = $dataReader->data();
	}


}