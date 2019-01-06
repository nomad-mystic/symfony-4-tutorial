<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/23/18
 * Time: 8:59 PM
 */

namespace App\Service;

use Psr\Log\LoggerInterface;

class Greeting
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var string
	 */
	private $message;

	public function __construct(LoggerInterface $logger, string $message)
	{
		$this->logger = $logger;
		$this->message = $message;
	}

	/**
	 * @param string $name
	 * @return string
	 */
	public function greet (string $name): string
	{
		$this->logger->info("$name parameter");
		return "$this->message $name";
	}
}
