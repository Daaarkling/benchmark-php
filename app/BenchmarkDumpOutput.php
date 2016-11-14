<?php


namespace Darkling\Benchmark;



class BenchmarkDumpOutput extends Benchmark
{

	protected function handleResult($result)
	{
		var_dump($result);
	}
}