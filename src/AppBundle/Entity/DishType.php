<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DishType
 *
 * @ORM\Table(name="dish_type",indexes={
 *     @ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})
 * })
 * @ORM\Entity
 */
class DishType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dish_type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dishTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;
}
