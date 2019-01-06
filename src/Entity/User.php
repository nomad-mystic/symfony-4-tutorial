<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @var $username
	 * @ORM\Column(type="string")
	 */
    private $username;

	/**
	 * @var $password
	 * @ORM\Column(type="string")
	 */
    private $password;

	/**
	 * @var $email
	 * @ORM\Column(type="string")
	 */
    private $email;

	/**
	 * @var $fullname
	 * @ORM\Column(type="string")
	 */
	private $fullname;



	



    public function getId(): ?int
    {
        return $this->id;
    }

	/**
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username): void
	{
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password): void
	{
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email): void
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getFullname()
	{
		return $this->fullname;
	}

	/**
	 * @param mixed $fullname
	 */
	public function setFullname($fullname): void
	{
		$this->fullname = $fullname;
	}
}
