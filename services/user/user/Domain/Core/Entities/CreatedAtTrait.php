<?php

namespace EmeraldIsland\Domain\Core\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAtTrait
{
    /**
     * @ORM\Column(type="datetime", name="created_at")
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