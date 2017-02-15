<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DishCategory
 *
 * @ORM\Table(name="dish_category", indexes={
 *     @ORM\Index(name="dish_category_category_idx", columns={"parent_id"})
 * })
 * @ORM\Entity
 */
class DishCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dish_category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \AppBundle\Entity\DishCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DishCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="dish_category_id")
     * })
     */
    private $parent;

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DishCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\DishCategory $parent
     *
     * @return DishCategory
     */
    public function setParent(\AppBundle\Entity\DishCategory $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\DishCategory
     */
    public function getParent()
    {
        return $this->parent;
    }
}
