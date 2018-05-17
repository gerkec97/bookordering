<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 16/05/2018
 * Time: 23:28
 */

namespace EmeraldIsland\Domain\Domain\ValueObject;


class User
{

    /**
     * @var UserName
     */
    private $userName;

    /**
     * @var LastName
     */
    private $lastName;

    /**
     * @var FirstName
     */
    private $firstName;

    /**
     * @var Email
     */
    private $email;

    /**
     * User constructor.
     */
    public function __construct(UserName $userName, Email $email, FirstName $firstName, LastName $lastName)
    {
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return LastName
     */
    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    /**
     * @return FirstName
     */
    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

}