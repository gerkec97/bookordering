<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 16/05/2018
 * Time: 23:17
 */

namespace EmeraldIsland\Domain\Domain\ValueObject;


use Assert\Assertion;

class UserName
{

    private $userName;

    /**
     * UserName constructor.
     */
    public function __construct(string $userName)
    {
        Assertion::string($userName);

        $this->userName = $userName;
    }

    /**
     * @return UserName
     */
    public function getUserName()
    {
        return new self($this->userName);
    }


}