<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/23/18
 * Time: 9:41 PM
 */

namespace App\Command;


use App\Service\Greeting;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
	private $greeting;

	/**
	 * HelloCommand constructor.
	 * @param Greeting $greeting
	 */
	public function __construct(Greeting $greeting)
	{
		$this->greeting = $greeting;

		parent::__construct();

	}

	protected function configure()
	{
		$this->setname('app:say-hello')
			->setDescription('Says hello to the user')
			->addArgument('name', InputArgument::REQUIRED);
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int|null|void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$name = $input->getArgument('name');
		$output->writeln([
			'Hello from the app',
			'====================',
			''
		]);
		$output->writeln($this->greeting->greet($name));
	}
}
