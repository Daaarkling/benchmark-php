<?php

namespace Benchmark\Metrics\Avro;


use AvroDataIOReader;
use AvroDataIOWriter;
use AvroIODatumReader;
use AvroStringIO;
use Benchmark\Metrics\AMetric;


class AvroOfficial extends AMetric
{



	public function encode($data)
	{
		$schema = file_get_contents(__DIR__ . '/../../Convertors/Avro/avro_schema.json');
		$writerSchema = \AvroSchema::parse($schema);
		$writer = new \AvroIODatumWriter($writerSchema);
		$io = new AvroStringIO();
		$dataWriter = new AvroDataIOWriter($io, $writer, $writerSchema);

		$start = microtime(TRUE);
		$dataWriter->append($data);
		$dataWriter->close();
		$string = $io->string();
		$time = microtime(TRUE) - $start;

		return [
			'time' => $time,
			'string' => $string
		];
	}



	public function decode($data)
	{
		$readIO = new AvroStringIO($data);

		$start = microtime(TRUE);
		$dataReader = new AvroDataIOReader($readIO, new AvroIODatumReader());
		$data = $dataReader->data();
		$time = microtime(TRUE) - $start;

		return $time;
	}


}