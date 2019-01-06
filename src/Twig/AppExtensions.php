<?php
/**
 * Created by PhpStorm.
 * User: keith
 * Date: 8/24/18
 * Time: 7:51 PM
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtensions extends AbstractExtension implements GlobalsInterface
{

	/**
	 * @var string
	 */
	private $locale;

	public function __construct (string $locale)
	{
		$this->locale = $locale;
	}

	public function getGlobals ()
	{
		return [
			'local' => $this->locale,
		];
	}

	public function getFilters (): array
	{
		return [
			new TwigFilter('price', [$this, 'priceFilter'])
		];
	}

	public function priceFilter (float $number, int $decimals = 2): string
	{
		return '$' . number_format($number, $decimals);
	}
}