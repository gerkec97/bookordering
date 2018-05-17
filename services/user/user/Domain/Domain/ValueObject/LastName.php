<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 16/05/2018
 * Time: 23:17
 */

namespace EmeraldIsland\Domain\Domain\ValueObject;

use Assert\Assertion;

class LastName
{

    private $lastName;

    /**
     * LastName constructor.
     */
    public function __construct(string $lastName = null)
    {
        Assertion::nullOrString($lastName);

        $this->lastName;
    }

    /**
     * @return LastName
     */
    public function getLastName()
    {
        return new self($this->lastName);
    }


}