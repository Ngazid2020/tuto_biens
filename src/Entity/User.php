<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
	/**
	 * Returns the roles granted to the user.
	 * public function getRoles()
	 * {
	 * return ['ROLE_USER'];
	 * }
	 * 
	 * Alternatively, the roles might be stored on a ``roles`` property,
	 * and populated in any number of different ways when the user object
	 * is created.
	 *
	 * @return mixed (Role|string)[] The user roles
	 */
	function getRoles() {
        return ['ROLE_ADMIN'];
	}
	
	/**
	 * Returns the salt that was originally used to encode the password.
	 * This can return null if the password was not encoded using a salt.
	 *
	 * @return null|string The salt
	 */
	function getSalt() {
        return null;
	}
	
	/**
	 * Removes sensitive data from the user.
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 *
	 * @return mixed
	 */
	function eraseCredentials() {
	}
	/**
	 * String representation of object
	 * Should return the string representation of the object.
	 *
	 * @return string
	 */
	function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
	}
	
	/**
	 * Constructs the object
	 * Called during unserialization of the object.
	 *
	 * @param string $serialized The string representation of the object.
	 */
	function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
	}
}
