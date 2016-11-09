<?php


namespace Benchmark\Commands;


use Benchmark\Benchmark;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Command
{
	protected function configure()
	{
		$this->setName('benchmark:run')
			->setDescription('run benchmark')
			->setHelp('help me');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{

		$config = [
			'repetitions' => 10,
			'outputToFile' => TRUE,
			'testData' => 'testdata.json',
			'tests' => [
				'encoders' => [
					'converter' => '\Benchmark\Encoders\ArrayConverter',
					'formats' => [
						'native' => [
							[
								'name' => 'PHP native function serialize',
								'class' => '\Benchmark\Encoders\Native\PhpSerializeFunction',
								'url' => 'http://php.net/manual/en/function.serialize.php',
								'version' => NULL,
							],
						],
						'xml' => [
							[
								'name' => 'PHP custom function toXml',
								'class' => '\Benchmark\Encoders\Xml\PhpCustomToXmlFunction',
								'url' => 'http://snipplr.com/view/3491/convert-php-array-to-xml-or-simple-xml-object-if-you-wish/',
								'version' => NULL,
							],
						],
						'json' => [
							[
								'name' => 'PHP native function json_encode',
								'class' => '\Benchmark\Encoders\Json\NativeJsonEncodeFunction',
								'url' => 'http://php.net/manual/en/function.json-encode.php',
								'version' => NULL,
							],
						]
					]
				]
			]
		];

		$benchmark = new Benchmark($config);
		$benchmark->run();
	}


}