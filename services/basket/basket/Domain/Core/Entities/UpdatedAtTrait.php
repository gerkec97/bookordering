<?php

namespace GkBasket\Domain\Core\Entities;

use Carbon\Carbon;

trait UpdatedAtTrait
{
    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return Carbon::instance($this->updatedAt);
    }

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}