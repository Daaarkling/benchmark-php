<?php
/**
 * Created by PhpStorm.
 * User: Jan Vaňura
 * Date: 8. 11. 2016
 * Time: 22:21
 */

namespace Benchmark\Encoders;


interface IEncoder
{
	/**
	 * @param array $data
	 * @return string
	 */
	public function encode($data);
}