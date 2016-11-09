<?php
/**
 * Created by PhpStorm.
 * User: Jan Vaňura
 * Date: 8. 11. 2016
 * Time: 22:08
 */

namespace App\Decoders;


interface IDecoder
{
	/**
	 * @return array
	 */
	public function decode();
}