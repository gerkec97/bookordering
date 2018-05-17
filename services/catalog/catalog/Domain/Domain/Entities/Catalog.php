<?php

namespace GkCatalog\Domain\Domain\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Catalog
 * @package GkCatalog\Domain\Domain\Entities
 * @ORM\Entity(repositoryClass="GkCatalog\Infrastructure\Persistence\Doctrine\Repositories\Domain\CatalogRepository")
 * @ORM\Table(name="catalog")
 */
class Catalog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

     /**
     * @ORM\Column(type="string")
     */
    private $isbn;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

}