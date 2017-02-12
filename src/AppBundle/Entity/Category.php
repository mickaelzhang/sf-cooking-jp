<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category", indexes={@ORM\Index(name="category_category_type_idx", columns={"category_type_id"}), @ORM\Index(name="category_category_idx", columns={"parent_id"})})
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
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
     * @var \AppBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="category_id")
     * })
     */
    private $parent;

    /**
     * @var \AppBundle\Entity\CategoryType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoryType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_type_id", referencedColumnName="category_type_id")
     * })
     */
    private $categoryType;



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
     * @return Category
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
     * @param \AppBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\AppBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set categoryType
     *
     * @param \AppBundle\Entity\CategoryType $categoryType
     *
     * @return Category
     */
    public function setCategoryType(\AppBundle\Entity\CategoryType $categoryType = null)
    {
        $this->categoryType = $categoryType;

        return $this;
    }

    /**
     * Get categoryType
     *
     * @return \AppBundle\Entity\CategoryType
     */
    public function getCategoryType()
    {
        return $this->categoryType;
    }
}
