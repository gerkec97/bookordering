<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 16/05/2018
 * Time: 23:17
 */

namespace EmeraldIsland\Domain\Domain\ValueObject;


use Assert\Assertion;

class Email
{

    private $email;

    /**
     * Email constructor.
     */
    public function __construct(string $email)
    {
        Assertion::email($email);

        $this->email = $email;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return new self($this->email);
    }


}