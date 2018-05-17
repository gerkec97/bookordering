<?php

namespace EmeraldIsland\Domain\Core\Entities;

trait PrimaryKeyTrait
{
    /** @var mixed */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}