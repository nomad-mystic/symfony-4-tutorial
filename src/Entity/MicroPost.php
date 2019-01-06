<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MicroPostRepository")
 * @ORM\Table()
 */
class MicroPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @ORM\Column(type="string", length=280)
	 * @Assert\NotBlank()
	 * @Assert\Length(min="10", minMessage="Please add a post of more then 10 characters")
	 */
	private $text;

	/**
	 * @var $time
	 * @ORM\Column(type="datetime")
	 */
	private $time;

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param mixed $text
	 */
	public function setText($text): void
	{
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getTime()
	{
		return $this->time;
	}

	/**
	 * @param mixed $time
	 */
	public function setTime(\DateTime $time): void
	{
		$this->time = $time;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
    {
        return $this->id;
    }
}
