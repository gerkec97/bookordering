<?php

namespace EmeraldIsland\Domain\Domain\Entities;

use Carbon\Carbon;
use EmeraldIsland\Domain\Core\Entities\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class User
 * @package EmeraldIsland\Domain\Domain\Entities
 * @ORM\Entity(repositoryClass="EmeraldIsland\Infrastructure\Persistence\Doctrine\Repositories\Domain\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{

    use TimestampsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="user_name")
     */
    private $username;

    /**
     * @ORM\Column(type="string", name="first_name")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="last_name")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * User constructor.
     */
    public function __construct($username)
    {
        $this->username = $username;
        $this->setCreatedAt(Carbon::now());
        $this->setUpdatedAt(Carbon::now());
    }
     // code goes here
}