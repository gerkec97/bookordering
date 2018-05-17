<?php
/**
 * Created by PhpStorm.
 * User: gerritkeck
 * Date: 17/05/2018
 * Time: 11:55
 */

namespace EmeraldIsland\Domain\Domain\Exceptions;

use EmeraldIsland\Domain\Core\Exceptions\AlreadyExistsException;

class UserAlreadyExistsException extends AlreadyExistsException
{
    /**
     * @param string $userName
     * @return UserAlreadyExistsException
     */
    public static function exists(string $userName)
    {
        return new self(
            sprintf('User with username [%s] already exists!', $userName)
        );
    }

}