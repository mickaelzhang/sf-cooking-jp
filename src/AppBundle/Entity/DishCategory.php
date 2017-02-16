<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Recipe", mappedBy="dishCategories")
     */
    protected $recipe;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
    }

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

    /**
     * Add recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     *
     * @return DishCategory
     */
    public function addRecipe(\AppBundle\Entity\Recipe $recipe)
    {
        $this->recipe[] = $recipe;

        return $this;
    }

    /**
     * Remove recipe
     *
     * @param \AppBundle\Entity\Recipe $recipe
     */
    public function removeRecipe(\AppBundle\Entity\Recipe $recipe)
    {
        $this->recipe->removeElement($recipe);
    }

    /**
     * Get recipe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
