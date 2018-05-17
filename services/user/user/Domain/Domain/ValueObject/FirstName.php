<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 16/05/2018
 * Time: 23:17
 */

namespace EmeraldIsland\Domain\Domain\ValueObject;


use Assert\Assertion;

class FirstName
{

    private $firstName;

    /**
     * FirstName constructor.
     */
    public function __construct(string $firstName)
    {
        Assertion::string($firstName);

        $this->firstName;
    }

    /**
     * @return FirstName
     */
    public function getFirstName()
    {
        return new self($this->firstName);
    }


}