<?php

namespace GkOrder\Domain\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use GkOrder\Domain\Core\Entities\TimestampsTrait;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

/**
 * Class Order
 * @package GkOrder\Domain\Domain\Entities
 * @ORM\Entity(repositoryClass="GkOrder\Infrastructure\Persistence\Doctrine\Repositories\Domain\OrderRepository")
 * @ORM\Table(name="store_order")
 */
class Order
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
     * @ORM\Column(type="string", name="order_number")
     */
    private $orderNumber;

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param mixed $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $isbn13;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Basket constructor.
     * @param $uuid
     */
    public function __construct()
    {
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
    public function getIsbn13()
    {
        return $this->isbn13;
    }

    /**
     * @param mixed $isbn13
     */
    public function setIsbn13($isbn13)
    {
        $this->isbn13 = $isbn13;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }



    // code goes here
}