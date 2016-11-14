<?php


namespace Darkling\Benchmark;



class BenchmarkCsvOutput extends Benchmark
{

	protected function handleResult($result)
	{
		var_dump($result);
	}
}