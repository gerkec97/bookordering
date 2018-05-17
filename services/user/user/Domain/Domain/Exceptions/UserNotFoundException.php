<?php

namespace EmeraldIsland\Domain\Domain\Exceptions;

use EmeraldIsland\Domain\Core\Exceptions\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    /**
     * @param int $id
     * @return UserNotFoundException
     */
    public static function byId(int $id)
    {
        return new self(
            sprintf('User with id [%d] not found!', $id)
        );
    }

    /**
     * @param string $userName
     * @return UserNotFoundException
     */
    public static function byUserName(string $userName)
    {
        return new self(
            sprintf('User with username [%s] not found!', $userName)
        );
    }

}