<?php

namespace GkBasket\Domain\Core\Entities;

use Carbon\Carbon;

trait CreatedAtTrait
{
    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return Carbon::instance($this->createdAt);
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt)
    {
        $this->createdAt = $createdAt;
    }
}