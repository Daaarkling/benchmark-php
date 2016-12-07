<?php

namespace Benchmark\Units\Avro;


use AvroDataIOReader;
use AvroIODatumReader;
use AvroStringIO;
use Benchmark\Units\AUnitBenchmark;


class AvroOfficial extends AUnitBenchmark
{

	/** @var \AvroSchema  */
	private $writerSchema;

	/** @var \AvroIODatumWriter  */
	private $writer;


	protected function prepareBenchmark()
	{
		$schema = file_get_contents(__DIR__ . '/../../Convertors/Avro/avro_schema.json');
		$this->writerSchema = \AvroSchema::parse($schema);
		$this->writer = new \AvroIODatumWriter($this->writerSchema);
	}



	public function encode($data)
	{
		$io = new \AvroStringIO();
		$dataWriter = new \AvroDataIOWriter($io, $this->writer, $this->writerSchema);
		$dataWriter->append($data);
		$dataWriter->close();
		return $io->string();
	}



	public function decode($data)
	{
		$readIO = new AvroStringIO($data);
		$dataReader = new AvroDataIOReader($readIO, new AvroIODatumReader());
		$data = $dataReader->data();
	}


}