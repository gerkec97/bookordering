<?php

namespace GkBasket\Domain\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use GkBasket\Domain\Core\Entities\TimestampsTrait;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
/**
 * Class Basket
 * @package GkBasket\Domain\Domain\Entities
 * @ORM\Entity(repositoryClass="GkBasket\Infrastructure\Persistence\Doctrine\Repositories\Domain\BasketRepository")
 * @ORM\Table(name="basket")
 */
class Basket
{
    use TimestampsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $items;

    /**
     * @ORM\Column(type="string")
     */
    private $uuid;

    /**
     * Basket constructor.
     * @param $uuid
     */
    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
        $this->setCreatedAt(Carbon::now());
        $this->setUpdatedAt(Carbon::now());
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    // code goes here
}